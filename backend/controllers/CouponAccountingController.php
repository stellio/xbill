<?php

namespace backend\controllers;

use Yii;
use backend\models\ContractorGroup;
use backend\models\CouponPack;
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
    public function actionIndex()
    {
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

        foreach(explode(',', $numbers) as $number) {

            $number = trim($number);

            $couponPack = CouponPack::find()->where(
                'number_from <= :number and :number <= number_to',['number' => $number])->one();

            if ($couponPack) {
                $result = $this->pushCouponToSold($number, $couponPack->id);
                if (!$result) {
                    $resultReport[] = sprintf(
                        '<span class="label label-danger">%s</span> - ошибка, добавить не удалось',
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
            $coupon = new CouponSold();
            $coupon->coupon_pack_id = $packId;
            $coupon->sold_count = 1;
            return $coupon->save();
        }
    }


    private function pushCouponAsGroupToSold($number, $packId) {

        $toDay = date('d-m-Y');

        // find saved coupon at present day
        $coupon = CouponSold::find()->where(["DATE_FORMAT( FROM_UNIXTIME( sold_at ), '%d-%m-%Y' )" => $toDay])->andWhere(['coupon_pack_id' => $packId])->one();

        // if coupon(s) exist at present day, increment sold number
        if ($coupon) {
            $coupon->sold_count = intval($coupon->sold_count) + 1;
            $coupon->trip_count = intval($coupon->sold_count) + 1;
            return $coupon->save();

        // if not, create new
        } else {
            $coupon = new CouponSold();
            $coupon->coupon_pack_id = $packId;
            $coupon->sold_count = 1;
            return $coupon->save();
        }
    }


    public function actionEnterGroup() {
        return $this->render('index');
    }
}
