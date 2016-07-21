<?php

namespace backend\controllers;

use Yii;
use backend\models\ContractorGroup;
use backend\models\CouponPack;
use backend\models\CouponSoldNumbers;
use backend\models\CouponSold;
use backend\models\AccountingCouponForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractorGroupController implements the CRUD actions for ContractorGroup model.
 */
class CouponAccountingController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ContractorGroup models.
     * @return mixed
     */
    public function actionIndex()  {
        return $this->render('index');
    }


    public function actionEnter() {

        $this->layout = 'minimal';
        $model = new AccountingCouponForm();
        $report = array();

        if ($model->load(Yii::$app->request->post())) {
            $report = $this->accountingCouponNumbers($model->numbers);
            // show "All Good" erros if empty
            if (count($report) < 1) {
                Yii::$app->getSession()->setFlash('alert', [
                       'body' => 'Номера успешно добавленны',
                       'options' => ['class'=>'alert-success']
               ]);
            }
        }
        return $this->render('accounting-coupon', [
            'model' => $model,
            'report' => $report,
        ]);
    }


    private function accountingCouponNumbers($numbers) {
        $resultReport = [];
        $dublicateCouponNumbers = [];
        foreach(explode(',', $numbers) as $number) {

            $number = trim($number);
            $couponPack = CouponPack::find()->where(
                'number_from <= :number and :number <= number_to',['number' => $number])->one();

            if (empty($number))
                break;

            if ($couponPack) {

                $isUnique = $this->isUnique($number);
                if ($isUnique) {
                    $result = $this->pushCouponToSold($number, $couponPack->id);
                    if (!$result) {
                        $resultReport[] = sprintf(
                            '<span class="label label-danger">%s</span> - ошибка, добавить не удалось',
                            $number
                        );
                    }
                    $this->updateTotals($couponPack->id);
                } else {
                    $resultReport[] = sprintf(
                        '<span class="label label-danger">%s</span> - повтор номера',
                        $number
                    );
                }


            } else {
                $resultReport[] = sprintf(
                    '<span class="label label-danger">%s</span> - неверный номер купона или диапазон купонов еще не занесен в систему',
                    $number
                );
            }
        }
        return $resultReport;
    }

    private function isUnique($number) {

        $coupon = new CouponSoldNumbers();

        $coupon->number = intval($number);
        return ($coupon->save()) ? true : false;
    }

    private function pushCouponToSold($number, $packId) {

        $toDay = date('d-m-Y');
        // find saved coupon at present day
        $coupon = CouponSold::find()->where(["DATE_FORMAT( FROM_UNIXTIME( sold_at ), '%d-%m-%Y' )" => $toDay])->andWhere(['coupon_pack_id' => $packId])->one();
        // if coupon(s) exist at present day, increment sold number
        if ($coupon) {
            $coupon->sold_count = intval($coupon->sold_count) + 1;
            return $coupon->save();
        // if not, create new
        } else {
            unset($couopn);
            $coupon = new CouponSold();
            $coupon->coupon_pack_id = $packId;
            $coupon->sold_count = 1;
            return $coupon->save();
        }
    }

    public function actionEnterGroup() {
        $this->layout = 'minimal';
        $model = new AccountingCouponForm();
        $report = array();

        if ($model->load(Yii::$app->request->post())) {
            $report = $this->accountingCouponGroupNumbers($model->numbers);
            // show "All Good" erros if empty
            if (count($report) < 1) {
                Yii::$app->getSession()->setFlash('alert', [
                       'body' => 'Номера успешно добавленны',
                       'options' => ['class'=>'alert-success']
               ]);
            }
        }
        return $this->render('accounting-coupon-group', [
            'model' => $model,
            'report' => $report,
        ]);
    }

    private function accountingCouponGroupNumbers($numbers) {
        $resultReport = [];
        $packs = [];

        foreach(explode(',', $numbers) as $number) {

            $number = trim($number);
            $couponPack = CouponPack::find()->where(
                'number_from <= :number and :number <= number_to',['number' => $number])->one();

            if ($couponPack) {
                $id = $couponPack->id;
                $packs[$id] = (array_key_exists($id, $packs)) ? $packs[$id] = $packs[$id] + 1 : $packs[$id] = 1;

            } else {
                $resultReport[] = sprintf(
                    '<span class="label label-danger">%s</span> - неверный номер купона или диапазон купонов еще не занесен в систему',
                    $number
                );
            }
        }

        foreach ($packs as $id => $count) {
            $result = $this->pushCouponAsGroupToSold('0', $id, $count);
            $this->updateTotals($id);
            if (!$result) {
                $resultReport[] = sprintf(
                    '<span class="label label-danger">%s</span> - ошибка, добавить не удалось',
                    $number
                );
            }
        }


        return $resultReport;
    }

    private function pushCouponAsGroupToSold($number, $packId, $soldCount) {

        $toDay = date('d-m-Y');
        // find saved coupon at present day
        $coupon = CouponSold::find()->where(["DATE_FORMAT( FROM_UNIXTIME( sold_at ), '%d-%m-%Y' )" => $toDay])->andWhere(['coupon_pack_id' => $packId])->one();
        // if coupon(s) exist at present day, increment sold number
        if ($coupon) {
            $coupon->sold_count = $coupon->sold_count + $soldCount;
            $coupon->trip_count = intval($coupon->trip_count) + 1;
            return $coupon->save();
        // if not, create new
        } else {
            $coupon = new CouponSold();
            $coupon->coupon_pack_id = $packId;
            $coupon->sold_count = $soldCount;
            $coupon->trip_count = 1;
            return $coupon->save();
        }
    }

    private function updateTotals($couponPackId) {

        $sold_total = 0;
        $trip_total = 0;

        $coupons = CouponSold::find()->where(['coupon_pack_id' => $couponPackId])->all();
        foreach($coupons as $c) {
            $sold_total += intval($c->sold_count);
            $trip_total += intval($c->trip_count);
        }

        $pack = CouponPack::find()->where(['id' => $couponPackId])->one();
        $pack->sold_total = $sold_total;
        $pack->trip_total = $trip_total;
        $pack->save();
    }

}
