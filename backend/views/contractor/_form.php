<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\Contractor */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="contractor-form">

    <?php $form = ActiveForm::begin([
        'id' => 'tour',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ],
        ]
]); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'contractor_group_id')->widget(
        Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(
            $group,
            'id',
            'name'
        ),
        'language' => 'ru',
        'options' => ['placeholder' => "нет"],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->hint('Если нет необходимой группы, создайте ее не отходя от кассы ;)') ?>


    <div class="form-group" style="margin-top: -15px;">
        <div class="col-sm-10 col-sm-offset-2">
            <div class="">
                <input type="button" class="btn btn-default" value="Создать новую группу"/>
            </div>
        </div>
    </div>


    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-sm-12">
            <div class="pull-right">
                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
