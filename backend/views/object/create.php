<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Object */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Object'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Objects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="object-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
