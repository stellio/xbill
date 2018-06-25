<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\modules\archivecoupons\models\ArchiveMode;

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
        return ArchiveMode::isOn('contractor');
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
    public function rules()
    {
        return [
            [['lastname'], 'required'],
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
            'firstname' => Yii::t('common', 'Firstname'),
            'lastname' => Yii::t('common', 'Lastname'),
            'phone' => Yii::t('common', 'Phone'),
            'contractor_group_id' => Yii::t('backend', 'Group'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'middlename' => Yii::t('common', 'Middlename'),
            'note' => Yii::t('backend', 'Note'),
            'name' => Yii::t('common', 'FullName'),
            'address' => Yii::t('backend', 'Address'),
            'city_id' => Yii::t('backend', 'City'),
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
