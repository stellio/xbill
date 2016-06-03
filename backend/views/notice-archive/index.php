<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\NoticeArchiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Notices');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-info"></i>Инфо</h4>
        С помощью этого раздела Вы можете рассылать экстренные сообщения всем контрагентам
</div>


<div class="box">
  <div class="box-body">
      <div class="accounting-coupn-form">

    <p>
        <a href="send-notice" class="btn btn-primary">Отправить уведомление</a>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'msg',
            // 'status',
            'created_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

        </div>
    </div>
</div>
