<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponPack */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="coupon-pack-form">

    <?php $form = ActiveForm::begin([
        'id' => 'coupon-pack-form',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::to('/coupon-pack/validate'),
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ],
        ]
    ]); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'contractor_id')->hiddenInput()->label(false); ?>

    <?php echo $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(
                       $types,
                       'id',
                       'name'
                   ), ['prompt'=>''])?>

    <?php echo $form->field($model, 'number_from')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'number_to')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'used_count')->textInput() ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <div class="col-sm-12">
            <div class="pull-right">
                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
