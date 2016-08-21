<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use trntv\yii\datetime\DateTimeWidget;

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
                        'data-target' => Url::to('/coupon-pack/create-modal?id=' . $model->id),
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
                          'issued_at:date',
                        //   'updated_at:date',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div>{remove}</div>',
                            'buttons' => [
                                'remove' => function ($url, $model) {
                                    $delButton = Html::a('
                                        <span title="Редактировать запись" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></span>', ['delete-coupon-pack', 'id' => $model->id], [
                                        'data' => [
                                            'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]);

                                    return $delButton;
                                }
                            ],
                        ],
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
   ?>
   <?php $form = ActiveForm::begin([
       'id' => 'coupon-pack-form',
       'action' => Url::to('/coupon-pack/create-modal'),
       'enableAjaxValidation' => true,
       'validationUrl' => Url::to('/coupon-pack/validate'),
       'layout' => 'horizontal',
       'fieldConfig' => [
           'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
           'horizontalCssClasses' => [
               'label' => 'col-sm-3',
               'offset' => 'col-sm-offset-2',
               'wrapper' => 'col-sm-9',
               'error' => '',
               'hint' => '',
           ],
       ]
   ]); ?>

   <?php echo $form->errorSummary($coupon); ?>
   <?php echo $form->field($coupon, 'contractor_id')->hiddenInput()->label(false); ?>
   <?php echo $form->field($coupon, 'type_id')->dropDownList(ArrayHelper::map(
                      $types,
                      'id',
                      'name'
                  ), ['prompt'=>''])?>

   <?php echo $form->field($coupon, 'number_from')->textInput(['maxlength' => true]) ?>
   <?php echo $form->field($coupon, 'number_to')->textInput(['maxlength' => true]) ?>
   <?php echo $form->field($coupon, 'issued_at')->widget(DateTimeWidget::className(),
       [
           'phpDatetimeFormat' => 'dd.MM.yyyy',
           'momentDatetimeFormat' => 'DD.MM.YYYY'
   ]) ?>

   <div class="form-group">
       <div class="col-sm-12">
           <div class="pull-right">
               <?php echo Html::submitButton($coupon->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $coupon->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           </div>
       </div>
   </div>

   <?php ActiveForm::end(); ?>
<?php
   Modal::end();
?>


<?php
$script = <<< JS
    $('.btn-ajax-modal').on('click', function() {
         $('#modal').modal('show');
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>
