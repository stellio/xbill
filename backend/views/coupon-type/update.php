<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponType */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon Type',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="coupon-type-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
