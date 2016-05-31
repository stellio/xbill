<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Coupon Group Accounting');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (count($report)) : ?>
    <div class="box box-danger">
      <div class="box-body">
        <?php foreach ($report as $msg) : ?>
            <?= '<p>' . $msg . '</p>'; ?>
        <?php endforeach; ?>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
<?php endif; ?>


<div class="box">
  <div class="box-body">
      <div class="accounting-coupn-form">

          <?php $form = ActiveForm::begin([
              'id' => 'accounting-coupn-form',
          ]); ?>

          <?php echo $form->errorSummary($model); ?>

          <?php echo $form->field($model, 'numbers')->textArea([
              'maxlength' => true,
              'rows' => 15
          ]) ?>

          <div class="form-group">
              <div class="col-sm-12">
                  <div class="pull-right">
                      <?php echo Html::submitButton(Yii::t('backend', 'Add'), ['class' => 'btn btn-primary']) ?>
                  </div>
              </div>
          </div>

          <?php ActiveForm::end(); ?>

      </div>

  </div><!-- /.box-body -->
</div><!-- /.box -->
