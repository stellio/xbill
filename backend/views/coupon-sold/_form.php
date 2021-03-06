<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponSold */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="coupon-sold-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'coupon_pack_id')->textInput() ?>

    <?php echo $form->field($model, 'sold_count')->textInput() ?>

    <?php echo $form->field($model, 'trip_count')->textInput() ?>

    <?php echo $form->field($model, 'sold_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
