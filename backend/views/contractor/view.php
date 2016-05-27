<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\Contractor */

$this->title = Yii::t('backend', 'Contractor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contractors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-view">


    <div class="row">
        <div class="col-md-7">
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Купоны контрагента</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                  <?php echo GridView::widget([
                      'dataProvider' => $couponPack,
                      'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],
                          'number_from',
                          'number_to',
                          'used_count',
                          ['class' => 'yii\grid\ActionColumn'],
                      ],
                  ]); ?>
              </div><!-- /.box-body -->
              <div class="box-footer">
                  <p class="pull-right">
                  <?= Html::button('Add', [
                        'class' => 'btn btn-success btn-ajax-modal',
                        'data-target' => Url::to('/contractor/create'),
                    ]); ?>
                 </p>
              </div><!-- box-footer -->
            </div><!-- /.box -->

        </div>
        <div class="col-md-5">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Инфо</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                  <?php echo DetailView::widget([
                      'model' => $model,
                      'attributes' => [
                          'firstname',
                          'lastname',
                          'phone',
                          'contractor_group_id',
                      ],
                  ]) ?>
              </div><!-- /.box-body -->
              <div class="box-footer">
                  <p class="pull-right">
                      <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                      <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                          'class' => 'btn btn-sm btn-danger',
                          'data' => [
                              'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                              'method' => 'post',
                          ],
                      ]) ?>
                  </p>
              </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
    </div>

    <?php
       Modal::begin([
           'id' => 'modal_category',
           'header' => '<h4>Category</h4>',
       ]);
       echo '<div class="modal-content"></div>';
       Modal::end();
    ?>




</div>


<?php


$script = <<< JS
    $('.btn-ajax-modal').on('click', function() {
       $('#modal_category').modal('show')
           .find('.modal-content')
           .load($(this).attr('data-target'));
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);

?>
