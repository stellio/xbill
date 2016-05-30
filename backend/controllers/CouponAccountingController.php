<?php

namespace backend\controllers;

use Yii;
use backend\models\ContractorGroup;
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

    public function actionEnterNumbers() {

        $model = new AccountingCouponForm();
        return $this->render('accounting-coupon', [
            'model' => $model,
        ]);
    }

    public function actionEnterNumbersGroup() {
        return $this->render('index');
    }
}
