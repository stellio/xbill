<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$this->title = Yii::t('backend', 'Сброс системы');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
//начало многосточной строки, можно использовать любые кавычки
$script = <<< JS
    $('.parent-checkbox').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.child-checkbox').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            $('.child-checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>

<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-exclamation"></i>Внимание</h4>
        Перед сбросов обязательно сделайте архив текущей системы. <br>
        <?=Html::a('Перейти в раздел архивов', Url::to(['/archivecoupons/default/index']));?>
</div>


<div class="box">
  <div class="box-header ui-sortable-handle">
            <i class="fa fa-check-circle-o"></i>
            <h3 class="box-title">Выберите элементы для сброса</h3>
  </div>
  <div class="box-body">
    <div class="system-reset">
      <div class="user-form">
          <?php $form = ActiveForm::begin(); ?>

              <?php echo $form->field($model, 'contractor')->checkbox(['class' => 'parent-checkbox']) ?>
              <?php echo $form->field($model, 'contractor_coupon_pack', [
                  'checkboxTemplate' => "<div style=\"margin-left:20px\" class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"
                ])->checkbox(['class' => 'child-checkbox']) ?>

              <div class="form-group">
                  <?php echo Html::submitButton(Yii::t('backend', 'Сбросить'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
              </div>
          <?php ActiveForm::end(); ?>
      </div>
    </div>
</div>
