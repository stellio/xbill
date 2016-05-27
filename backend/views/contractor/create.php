<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Contractor */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Контрагента',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contractors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'group' => $group,
    ]) ?>

</div>
