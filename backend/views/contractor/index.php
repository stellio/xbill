<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\base\Object;

use yii\helpers\ArrayHelper;
use backend\models\ContractorGroup;
use backend\models\Contractor;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Contractors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Add {modelClass}', [
    'modelClass' => 'Контрагента',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'firstname',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'firstname',
                    'data' => ArrayHelper::map(Contractor::find()->asArray()->all(), 'firstname', 'firstname'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'lastname',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'lastname',
                    'data' => ArrayHelper::map(Contractor::find()->asArray()->all(), 'lastname', 'lastname'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'phone',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'phone',
                    'data' => ArrayHelper::map(Contractor::find()->asArray()->all(), 'phone', 'phone'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'name',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'name',
                    'data' => ArrayHelper::map(Contractor::find()->asArray()->all(), 'name', 'name'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
              'attribute' => 'contractor_group_id',
              'value' => function($model) {
                  return ($model->group) ? $model->group->name : '';
              },
              'filter' => Select2::widget([
                  'model' => $searchModel,
                  'attribute' => 'contractor_group_id',
                  'data' => ArrayHelper::map(ContractorGroup::find()->all(), 'id', 'name'),
                  'options' => [
                      'placeholder' => 'Поиск'
                  ],
                  'pluginOptions' => [
                      'allowClear' => true
                  ],
              ])
            ],
            // 'status',
            'created_at:date',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div style="width: 110px">{view}{update}{remove}</div>',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                                '<span title="Добавить купон" class="btn btn-warning btn-xs"><i class="fa fa-ticket"></i></span> ',
                            $url);
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                                '<span title="Редактировать запись" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></span>',
                            $url);
                    },
                    'remove' => function ($url, $model) {
                        $delButton = Html::a('
                            <span title="Редактировать запись" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></span>', ['delete', 'id' => $model->id], [
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

</div>
