<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponPack */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon Pack',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Packs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="coupon-pack-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
