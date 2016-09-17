<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\models\CouponPack;
use backend\modules\archivecoupons\models\ArchiveMode;
/**
 * This is the model class for table "coupon_sold_numbers".
 *
 * @property integer $id
 * @property integer $number
 * @property integer $created_at
 * @property integer $updated_at
 */
class CouponSoldNumbers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return ArchiveMode::isOn('coupon_sold_numbers');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'created_at', 'updated_at'], 'integer'],
            ['number', 'unique']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'number' => Yii::t('backend', 'Number'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    public function getContractorName() {

        $number = $this->number;

        $model = CouponPack::find()->where(
            'number_from <= :number and :number <= number_to',['number' => $number])->one();

        if ($model) {
            return ($model->contractor) ? $model->contractor->name : '';
        }

        return ('(нe задано)');
    }

    public function getContractorFullName() {

        $number = $this->number;

        $model = CouponPack::find()->where(
            'number_from <= :number and :number <= number_to',['number' => $number])->one();

        if ($model) {
            return ($model->contractor) ? $model->contractor->lastname . ' ' . $model->contractor->firstname : '';
        }

        return ('(нe задано)');
    }

}
