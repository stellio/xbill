<?php

namespace backend\modules\archivecoupons\controllers;

use Yii;
use backend\modules\archivecoupons\models\ArchiveCoupons;
use backend\modules\archivecoupons\models\ArchiveOptions;
use backend\modules\archivecoupons\models\search\ArchiveCouponsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for ArchiveCoupons model.
 */
class DefaultController extends Controller
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


    private function createArchive($id) {

      $connection = Yii::$app->getDb();

      /*
        Table names
      */
      $tables = [
        'city',
        'contractor',
        'contractor_coupon_pack',
        'contractor_group',
        'coupon_sold',
        'coupon_sold_numbers',
        'coupon_type'
      ];

      foreach ($tables as $name) {
        $command = $connection->createCommand(
            "CREATE TABLE `" . $name . "_" . $id . "` LIKE " . $name);
        $result = $command->execute();

        $command2 = $connection->createCommand(
            "INSERT INTO `" . $name . "_" . ($id) . "` SELECT * FROM " . $name . " GROUP BY ID");
        $result = $command2->execute();
      }


    }

    /**
     * Lists all ArchiveCoupons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '@backend/views/layouts/minimal';

        $searchModel = new ArchiveCouponsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArchiveCoupons model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

      // switch on Archive mode and set active archive id
      ArchiveOptions::set('is_archive_mode', 1);
      ArchiveOptions::set('active_archive_id', $id);

      return $this->redirect(['index']);
    }


    public function actionLeave() {

      // switch of Archvie mode
      ArchiveOptions::set('is_archive_mode', 0);
      ArchiveOptions::set('active_archive_id', 0);

      return $this->redirect(['index']);
    }
    /**
     * Creates a new ArchiveCoupons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArchiveCoupons();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->createArchive($model->id);
            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArchiveCoupons model.
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
            ]);
        }
    }

    /**
     * Deletes an existing ArchiveCoupons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

      $tables = [
        'city',
        'contractor',
        'contractor_coupon_pack',
        'contractor_group',
        'coupon_sold',
        'coupon_sold_numbers',
        'coupon_type'
      ];

      $connection = Yii::$app->getDb();

      foreach ($tables as $name) {
        $command = $connection->createCommand(
            "DROP TABLE `" . $name . "_" . $id . "`");
        $result = $command->execute();
      }


        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArchiveCoupons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArchiveCoupons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArchiveCoupons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
