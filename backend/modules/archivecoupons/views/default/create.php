<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\archivecoupons\models\ArchiveCoupons */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Archive Coupons',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Archive Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archive-coupons-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
