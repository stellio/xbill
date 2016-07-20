<?php

namespace backend\controllers;

use Yii;
use backend\models\CouponPack;
use backend\models\CouponType;
use backend\models\search\CouponPackSearch;
use yii\web\Response;
use yii\web\Controller;
use yii\bootstrap\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CouponPackController implements the CRUD actions for CouponPack model.
 */
class CouponPackController extends Controller
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
     * Lists all CouponPack models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CouponPackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CouponPack model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'types' => CouponType::find()->all(),
        ]);
    }

    /**
     * Creates a new CouponPack model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CouponPack();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'types' => CouponType::find()->all(),
            ]);
        }
    }

    public function actionCreateModal()
    {
        $model = new CouponPack();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/contractor/view', 'id' => $model->contractor_id]);
        }
        $model->contractor_id = $id;
        return $this->renderAjax('create', [
            'model' => $model,
            'types' => CouponType::find()->all(),
        ]);

    }

    public function actionValidate()
    {
        $model = new CouponPack();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing CouponPack model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'types' => CouponType::find()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing CouponPack model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CouponPack model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CouponPack the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CouponPack::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
