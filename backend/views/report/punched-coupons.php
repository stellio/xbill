<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CouponSoldNumbersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Coupon Sold Numbers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-sold-numbers-index">


<?php echo $this->render('/layouts/report-menu') ?>

<div class="box box-warning">
  <div class="box-header with-border ">
    <h3 class="box-title">Пробитые купоны</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <!-- <span class="label label-primary">Label</span> -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'number',
            'created_at:date',
            'updated_at:date',
        ],
    ]); ?>
 </div>
</div>

</div>
