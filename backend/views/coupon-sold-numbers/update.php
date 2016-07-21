<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponSoldNumbers */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon Sold Numbers',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Sold Numbers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="coupon-sold-numbers-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
