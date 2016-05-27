<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contractor_coupon_pack".
 *
 * @property integer $id
 * @property integer $contractor_id
 * @property string $number_from
 * @property string $number_to
 * @property integer $used_count
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contractor $contractor
 */
class CouponPack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor_coupon_pack';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number_from', 'number_to'], 'required'],
            [['contractor_id', 'used_count', 'created_at', 'updated_at', 'number_from', 'number_to'], 'integer'],
            [['contractor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['contractor_id' => 'id']],
            ['used_count', 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'contractor_id' => Yii::t('backend', 'Contractor'),
            'number_from' => Yii::t('backend', 'Number From'),
            'number_to' => Yii::t('backend', 'Number To'),
            'used_count' => Yii::t('backend', 'Sold'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'contractor_id']);
    }
}
