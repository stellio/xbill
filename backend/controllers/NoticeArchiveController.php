<?php

namespace backend\controllers;

use Yii;
use backend\models\Contractor;
use backend\models\NoticeForm;
use backend\models\NoticeArchive;
use backend\models\search\NoticeArchiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\StringHelper;
use fgh151\modules\epochta\eclasses\Addressbook;

/**
 * NoticeArchiveController implements the CRUD actions for NoticeArchive model.
 */
class NoticeArchiveController extends Controller
{
    const CAMPAIGN_ID = 640447;
    const CAMPAIGN_NAME = 'VipKupon';

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
     * Lists all NoticeArchive models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'minimal';

        $searchModel = new NoticeArchiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NoticeArchive model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NoticeArchive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NoticeArchive();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionSendNotice() {

        $this->updateRecipientsList();

        $this->layout = 'minimal';
        $model = new NoticeForm();

        if ($model->load(Yii::$app->request->post())) {
            $result = $this->sendNoticeImplement($model->msg);

            if ($result) {
                $this->pushToArchive($model->msg);

                Yii::$app->getSession()->setFlash('alert', [
                       'body' => 'Сообщение успешно отправленно',
                       'options' => ['class'=>'alert-success']
                ]);

                return $this->actionIndex();

            } else {
                Yii::$app->getSession()->setFlash('alert', [
                      'body' => 'Сообщение отправить не удалось',
                      'options' => ['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('send-notice', [
            'model' => $model,
        ]);

    }

    private function updateRecipientsList() {

        $contractors = Contractor::find()->all();

        if (!$contractors)
            return false;

        $campaignId = NoticeArchiveController::CAMPAIGN_ID;
        $gate = Yii::$app->getModule('smsGate');

        foreach ($contractors as $c) {
                $gate->addPhoneToBook(
                    $campaignId,
                    $c->phone,
                    sprintf('%s;%s;%s', $c->firstname, $c->lastname, $c->middlename)
                );
        }
        return true;
    }


    private function sendNoticeImplement($msg) {

        if (!$msg)
            return false;

        $gate = Yii::$app->getModule('smsGate');
        $response = $gate->createCampaign(
            NoticeArchiveController::CAMPAIGN_NAME,
            StringHelper::truncate($msg, 70, '...', null, true),
            NoticeArchiveController::CAMPAIGN_ID
        );

        if (count($response) == 0)
            return false;

        if (count($response['result']) == 0)
            return false;

        return true;
    }

    private function pushToArchive($msg) {

        $notice = new NoticeArchive();
        $notice->msg = $msg;
        $notice->save();
    }


    /**
     * Updates an existing NoticeArchive model.
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
     * Deletes an existing NoticeArchive model.
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
     * Finds the NoticeArchive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NoticeArchive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NoticeArchive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
