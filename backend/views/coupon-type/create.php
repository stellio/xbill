<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CouponType */

$this->title = Yii::t('backend', 'Add {modelClass}', [
    'modelClass' => 'Тип купона',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coupon Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-type-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
