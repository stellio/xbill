<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponPack */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="coupon-pack-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'contractor_id')->textInput() ?>

    <?php echo $form->field($model, 'number_from')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'number_to')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'used_count')->textInput() ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <?php echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
