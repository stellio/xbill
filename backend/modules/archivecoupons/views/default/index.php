<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\archivecoupons\models\search\ArchiveCouponsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Архивы');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="archive-coupons-index">

  <div class="box">
    <div class="box-body">
        <div class="accounting-coupn-form">
          <p>
              <?php echo Html::a(Yii::t('backend', 'Создать архив'), ['create'], ['class' => 'btn btn-success']) ?>
          </p>

          <?php echo GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],

                  // 'id',
                  'title',
                  'created_at:datetime',
                  // 'updated_at',
                  [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '<div style="width: 130px">{view}{remove}</div>',
                      'buttons' => [
                          'view' => function ($url,$model) {
                              return Html::a(
                                      '<span title="Перейти в режим архива" class="btn btn-primary btn-xs"><i class="fa fa-eject"></i></span>',
                                  $url);
                          },
                          'remove' => function ($url, $model) {
                              $delButton = Html::a('
                                  <span title="Удалить" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></span>', ['delete', 'id' => $model->id], [
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
      </div>
  </div>

  <div class="row">
    <div class="col-md-7">
      <div class="box">
        <div class="box-header ui-sortable-handle">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Инструкция</h3>
        </div>
        <div class="box-body">
            <div class="accounting-coupn-form">
              <p>Для просмотра записей определеного архива необходимо кликнуть по кнопке "Перейти в режим архива" - <span class="btn btn-primary btn-xs"><i class="fa fa-eject"></i></span></p>
              <p>Этот режим загружает архив в текущие состояние системы и позволяет просматривать все данные как в обычном режиме работы.<br>
              Для возврата в нормальный режим необходимо кликнуть по кнопке "Покинуть режим архива" которая будет распологаться на верхней панели только при активном режиме архива.</p>
            </div>
          </div>
      </div>
    </div>
  </div>



</div>
