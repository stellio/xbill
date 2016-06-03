<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NoticeArchive */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Notice Archive',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Notice Archives'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-archive-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
