<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CouponSoldSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="coupon-sold-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'coupon_pack_id') ?>

    <?php echo $form->field($model, 'sold_count') ?>

    <?php echo $form->field($model, 'trip_count') ?>

    <?php echo $form->field($model, 'sold_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
