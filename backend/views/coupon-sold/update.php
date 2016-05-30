<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponSold */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon Sold',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Solds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="coupon-sold-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
