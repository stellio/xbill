<?php

use backend\widgets\Menu;
use common\models\TimelineEvent;

 ?>

 <?php echo Menu::widget([
     'options'=>['class'=>'sidebar-menu'],
     'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
     'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
     'activateParents' => true,
     'items' => [
         [
             'label'=>Yii::t('backend', 'Главное меню'),
             'options' => ['class' => 'header']
         ],
         [
             'label' => Yii::t('backend', 'Contractors'),
             'icon' => '<i class="fa fa-user-secret"></i>',
             'url' => ['/contractor/index'],
             'visible'=>Yii::$app->user->can('administrator')
         ],
         [
             'label' => Yii::t('backend', 'Cities'),
             'icon' => '<i class="fa fa-university"></i>',
             'url' => ['/city/index'],
             'visible'=>Yii::$app->user->can('administrator')
         ],
         [
             'label' => Yii::t('backend', 'Agents Groups'),
             'icon' => '<i class="fa fa-users"></i>',
             'url' => ['/contractor-group/index'],
             'visible'=>Yii::$app->user->can('administrator')
         ],
         [
             'label' => Yii::t('backend', 'Coupon Packs'),
             'icon' => '<i class="fa fa-ticket"></i>',
             'url' => ['/coupon-pack/index'],
             'visible'=>Yii::$app->user->can('administrator')
         ],
         [
             'label' => Yii::t('backend', 'Coupon Types'),
             'icon' => '<i class="fa fa-clone"></i>',
             'url' => ['/coupon-type/index'],
             'visible'=>Yii::$app->user->can('administrator'),
         ],
         [
             'label' => Yii::t('backend', 'Coupon Accounting'),
             'icon' => '<i class="fa fa-file-text"></i>',
             'url' => ['/coupon-accounting/index'],
             'visible'=> (Yii::$app->user->can('administrator') || Yii::$app->user->can('paymaster')),
         ],
         [
             'label' => Yii::t('backend', 'Отчеты'),
             'icon' => '<i class="fa fa-area-chart"></i>',
             'url' => ['/report/index'],
             'visible'=>Yii::$app->user->can('administrator')
         ],
         [
             'label' => Yii::t('backend', 'Notices (SMS)'),
             'icon' => '<i class="fa fa-bullhorn"></i>',
             'url' => ['/notice-archive/index'],
             'visible'=>Yii::$app->user->can('administrator')
         ],
         [
             'label' => Yii::t('backend', 'Users'),
             'icon' => '<i class="fa fa-user"></i>',
             'url' => ['/user/index'],
             'visible' => Yii::$app->user->can('administrator')
         ],
         [
              'label' => Yii::t('backend', 'Система'),
              'url' => '',
              'icon' => '<i class="fa fa-gear"></i>',
              'options' => ['class' => 'treeview'],
              'visible'=>Yii::$app->user->can('administrator'),
              'items' => [
                  ['label' => Yii::t('backend', 'Архив'), 'url' =>['/archivecoupons/default/index'], 'icon' => '<i class="fa fa-circle-o"></i>'],
                  ['label' => Yii::t('backend', 'Сброс'), 'url' =>['/system/reset'], 'icon' => '<i class="fa fa-circle-o"></i>'],
              ]

          ],

     ]
 ]) ?>
