<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contractor".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property integer $contractor_group_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Group $group
 * @property CouponPack[] $couponPacks
 */
class Contractor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor';
    }

    public function behaviors()
   {
       return [
           TimestampBehavior::className()
       ];
   }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'phone'], 'required'],
            [['contractor_group_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 40],
            [['contractor_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContractorGroup::className(), 'targetAttribute' => ['contractor_group_id' => 'id']],
            ['status', 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'lastname' => Yii::t('common', 'Lastname'),
            'phone' => Yii::t('common', 'Phone'),
            'contractor_group_id' => Yii::t('backend', 'Group'),
            'status' => Yii::t('common', 'Status'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ContractorGroup::className(), ['id' => 'contractor_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponPacks()
    {
        return $this->hasMany(ContractorCouponPack::className(), ['contractor_id' => 'id']);
    }
}
