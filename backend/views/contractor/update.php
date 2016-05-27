<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Contractor */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Contractor',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contractors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="contractor-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'group' => $group,
    ]) ?>

</div>
