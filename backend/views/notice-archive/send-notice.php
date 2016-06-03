<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Send the notices');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
  <div class="box-body">
      <div class="accounting-coupn-form">

          <?php $form = ActiveForm::begin([
              'id' => 'accounting-coupn-form',
          ]); ?>

          <?php echo $form->errorSummary($model); ?>

          <?php echo $form->field($model, 'msg')->textArea([
              'maxlength' => true,
              'rows' => 5
          ])->hint('Макс. количество символов для сообщения - 70') ?>

          <?php echo Html::submitButton(Yii::t('backend', 'Send'), ['class' => 'btn btn-primary']) ?>

          <?php ActiveForm::end(); ?>

      </div>

  </div><!-- /.box-body -->
</div><!-- /.box -->
