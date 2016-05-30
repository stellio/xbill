<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CouponSold */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Coupon Sold',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Solds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-sold-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
