<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "coupon_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ContractorCouponPack[] $contractorCouponPacks
 */
class CouponType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorCouponPacks()
    {
        return $this->hasMany(ContractorCouponPack::className(), ['type_id' => 'id']);
    }
}
