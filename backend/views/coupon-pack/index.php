<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                'value' => function($model) {
                    return ($model->contractor) ? $model->contractor->name : '';
                }
            ],
            [
                'attribute' => 'contractor_id',
                'value' => function($model) {

                    return ($model->contractor) ? $model->contractor->lastname . ' ' . $model->contractor->firstname : '';
                }
            ],
            'number_from',
            'number_to',
            'issued_at:date',
            // 'used_count',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
