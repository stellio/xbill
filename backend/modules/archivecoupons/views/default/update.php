<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\archivecoupons\models\ArchiveCoupons */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Archive Coupons',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Archive Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="archive-coupons-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
