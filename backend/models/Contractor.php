<?php

namespace backend\models;

use Yii;

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
 * @property string $middlename
 * @property string $note
 * @property string $name
 * @property string $address
 * @property integer $city_id
 *
 * @property City $city
 * @property ContractorGroup $contractorGroup
 * @property ContractorCouponPack[] $contractorCouponPacks
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastname', 'phone'], 'required'],
            [['contractor_group_id', 'status', 'created_at', 'updated_at', 'city_id'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 40],
            [['middlename', 'note', 'name', 'address'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['contractor_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContractorGroup::className(), 'targetAttribute' => ['contractor_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'firstname' => Yii::t('backend', 'Firstname'),
            'lastname' => Yii::t('backend', 'Lastname'),
            'phone' => Yii::t('backend', 'Phone'),
            'contractor_group_id' => Yii::t('backend', 'Contractor Group ID'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'middlename' => Yii::t('backend', 'Middlename'),
            'note' => Yii::t('backend', 'Note'),
            'name' => Yii::t('backend', 'Name'),
            'address' => Yii::t('backend', 'Address'),
            'city_id' => Yii::t('backend', 'City ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
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
        return $this->hasMany(CouponPack::className(), ['contractor_id' => 'id']);
    }
}
