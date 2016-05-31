<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="row">
    <div class="col-lg-3 col-xs-3">
        <div class="small-box bg-aqua">
            <div class="inner">
                <p>
                    <b>Сводные данные</b>
                </p>
            </div>
            <div class="icon">
                <i class=""></i>
            </div>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['/report/summary']) ?>" class="small-box-footer">
                <?php echo Yii::t('backend', 'Показать') ?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-3">
        <div class="small-box bg-green">
            <div class="inner">
                <p>
                    <b>По агентам</b>
                </p>
            </div>
            <div class="icon">
                <i class=""></i>
            </div>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['/report/summary']) ?>" class="small-box-footer">
                <?php echo Yii::t('backend', 'Показать') ?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-3">
        <div class="small-box bg-yellow">
            <div class="inner">
                <p>
                    <b>По купонам</b>
                </p>
            </div>
            <div class="icon">
                <i class=""></i>
            </div>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['/report/summary']) ?>" class="small-box-footer">
                <?php echo Yii::t('backend', 'Показать') ?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-3">
        <div class="small-box bg-red">
            <div class="inner">
                <p>
                    <b>По датам</b>
                </p>
            </div>
            <div class="icon">
                <i class=""></i>
            </div>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['/report/summary']) ?>" class="small-box-footer">
                <?php echo Yii::t('backend', 'Показать') ?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
