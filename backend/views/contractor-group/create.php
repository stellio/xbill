<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractorGroup */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Contractor Group',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contractor Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-group-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
