<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SystemReset;
/**
 * ContractorGroupController implements the CRUD actions for ContractorGroup model.
 */
class SystemController extends Controller
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
    public function actionReset()
    {
      $this->layout = "minimal";

      $model = new SystemReset();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['reset']);
      } else {
          return $this->render('reset', [
              'model' => $model,
          ]);
      }
    }
}
