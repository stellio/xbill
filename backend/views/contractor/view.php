<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\Contractor */

$this->title = $model->firstname . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contractors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-view">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Купоны контрагента</h3>
                <div class="box-tools pull-right">
                    <?= Html::button('<i class="fa fa-plus-circle fa-lg"></i>', [
                        'class' => 'btn btn-success btn btn-ajax-modal',
                        'title' => 'Добавить купоны',
                        'data-target' => Url::to('/coupon-pack/create-modal?id=4'),
                    ]); ?>
                    <?= Html::a('<i class="fa fa-reply fa-lg"></i>',
                        Url::to('/contractor/index'), [
                            'class' => 'btn btn-default',
                            'title' => 'Вернуться'
                    ]); ?>
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body">
                  <?php echo GridView::widget([
                      'dataProvider' => $couponPack,
                      'summary'=>"",
                      'columns' => [
                          'number_from',
                          'number_to',
                          'sold_total',
                          'trip_total',
                          [
                              'attribute' => 'type_id',
                              'value' => function($model) {
                                  return ($model->type) ? $model->type->name : '';
                              }
                          ],
                          'created_at:date',
                          'updated_at:date',
                      ],
                  ]); ?>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>

<?php
   Modal::begin([
       'header' => '<h4 class="model-title">Добавить купоны</h4>',
       'headerOptions' => ['class' => 'modal-header'],
       'id' => 'modal',
       'size' => 'modal-md',
   ]);
   echo '<div class="modal-content modal-body">Loading...</div>';
   Modal::end();
?>


<?php
$script = <<< JS
    $('.btn-ajax-modal').on('click', function() {
       $('#modal').modal('show')
           .find('.modal-body')
           .load($(this).attr('data-target'));
           document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>
