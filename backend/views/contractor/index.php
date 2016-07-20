<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use backend\models\ContractorGroup;

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
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'firstname',
            'lastname',
            'phone',
            'name',
            [
              'attribute' => 'contractor_group_id',
              'value' => function($model) {
                  return $model->group->name;
              },
              'filter' => ArrayHelper::map(ContractorGroup::find()->all(), 'id', 'name')
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
                                '<span title="Добавить купон" class="btn btn-warning btn-sm"><i class="fa fa-ticket"></i></span> ',
                            $url);
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                                '<span title="Редактировать запись" class="btn btn-primary btn-sm"><i class="fa fa-gear"></i></span>',
                            $url);
                    },
                    'remove' => function ($url, $model) {
                        $delButton = Html::a('
                            <span title="Редактировать запись" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>', ['delete', 'id' => $model->id], [
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
