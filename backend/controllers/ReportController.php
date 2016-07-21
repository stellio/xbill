<?php

namespace backend\controllers;

use Yii;
use backend\models\ContractorGroup;
use backend\models\search\ContractorSearch;
use backend\models\search\CouponPackSearch;
use backend\models\search\CouponPackExtendedSearch;
use backend\models\CouponSoldNumbers;
use backend\models\search\CouponSoldNumbersSearch;
use backend\models\CouponPack;
use backend\models\CouponSold;
use backend\models\AccountingCouponForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractorGroupController implements the CRUD actions for ContractorGroup model.
 */
class ReportController extends Controller
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
        $this->layout = 'minimal';
        return $this->render('index');
    }

    public function actionSummary()
    {
        $searchModel = new CouponPackExtendedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = 'minimal';
        return $this->render('summary', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionByAgentsGroup()
    {
        $searchModel = new ContractorSearch();
        // $searchModel = new CouponPackExtendedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = 'minimal';
        return $this->render('contractors', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        // $this->layout = 'minimal';
        // return $this->render('index');
    }

    public function actionPunchedCoupons()
    {
        $this->layout = 'minimal';
        $searchModel = new CouponSoldNumbersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('punched-coupons', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionByDates()
    {
        $this->layout = 'minimal';
        return $this->render('index');
    }
}
