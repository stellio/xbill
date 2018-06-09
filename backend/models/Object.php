<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ContractorCouponPack[] $contractorCouponPacks
 */
class Object extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 1024],
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
        return $this->hasMany(ContractorCouponPack::className(), ['object_id' => 'id']);
    }
}
