<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
        return 'coupon_sold_numbers';
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
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
