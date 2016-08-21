<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\grid\GridView;

use backend\models\Contractor;
use backend\models\CouponPack;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CouponPackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Coupon Packs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-pack-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(
            Yii::t('backend', 'Search by coupon number'),
            ['search-coupon'],
            ['class' => 'btn btn-primary'])
        ?>
    </p>



    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'contractor_name',
                'noWrap' => true,
                'value' => function($model) {
                    return ($model->contractor) ? $model->contractor->name : '';
                }
            ],
            [
                'attribute' => 'contractor_id',
                'noWrap' => true,
                'value' => function($model) {

                    return ($model->contractor) ? $model->contractor->lastname . ' ' . $model->contractor->firstname : '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'contractor_id',
                    'data' => ArrayHelper::map(Contractor::find()->asArray()->all(), 'id', 'lastname'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])


            ],
            [
                'attribute' => 'number_from',
                'noWrap' => true,
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'number_from',
                    'data' => ArrayHelper::map(CouponPack::find()->asArray()->all(), 'number_from', 'number_from'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'number_to',
                'noWrap' => true,
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'number_to',
                    'data' => ArrayHelper::map(CouponPack::find()->asArray()->all(), 'number_to', 'number_to'),
                    'options' => [
                        'placeholder' => 'Поиск'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'issued_at',
                'format' => 'date',
                'noWrap' => true,
            ],
            // 'used_count',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
