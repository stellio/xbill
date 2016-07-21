<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CouponSoldNumbers */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Coupon Sold Numbers',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Sold Numbers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-sold-numbers-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
