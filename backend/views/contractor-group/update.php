<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractorGroup */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Contractor Group',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contractor Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="contractor-group-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
