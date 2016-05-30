<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Coupon Accounting');
$this->params['breadcrumbs'][] = $this->title;
?>

<a href="/coupon-accounting/enter-numbers" class="btn btn-success btn-lg">Ввести номера кунонов</a>
<a href="/coupon-accounting/enter-numbers-group" class="btn btn-success btn-lg">Ввести номера кунонов (группа)</a>
