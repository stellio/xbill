<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\NoticeArchive */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Notice Archive',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Notice Archives'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="notice-archive-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
