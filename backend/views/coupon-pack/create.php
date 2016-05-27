<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CouponPack */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Coupon Pack',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Packs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-pack-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
