<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Coupon Accounting');
$this->params['breadcrumbs'][] = $this->title;
?>

<a href="/coupon-accounting/enter" class="btn btn-success btn-lg">Ввести номера купонов</a>
<a href="/coupon-accounting/enter-group" class="btn btn-success btn-lg">Ввести номера купонов (группа)</a>
