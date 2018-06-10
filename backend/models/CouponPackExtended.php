<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\models\Contractor;
use backend\modules\archivecoupons\models\ArchiveMode;

/**
 * This is the model class for table "contractor_coupon_pack".
 *
 * @property integer $id
 * @property integer $contractor_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $number_from
 * @property integer $number_to
 * @property integer $sold_total
 * @property integer $trip_total
 * @property integer $status
 * @property integer $type_id
 * @property integer $issued_at
 *
 * @property Contractor $contractor
 * @property CouponType $type
 * @property CouponSold[] $couponSolds
 */
class CouponPackExtended extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return ArchiveMode::isOn('contractor_coupon_pack');
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'issued_at',
                'value' => new Expression('UNIX_TIMESTAMP(CURDATE())'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contractor_id', 'created_at', 'updated_at', 'number_from', 'number_to', 'sold_total', 'trip_total', 'status', 'object_id', 'type_id', 'issued_at'], 'integer'],
            [['contractor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['contractor_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CouponType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['object_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'contractor_id' => Yii::t('backend', 'Contractor ID'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'number_from' => Yii::t('backend', 'Number From'),
            'number_to' => Yii::t('backend', 'Number To'),
            'sold_total' => Yii::t('backend', 'Sold Total'),
            'trip_total' => Yii::t('backend', 'Trip Total'),
            'status' => Yii::t('backend', 'Status'),
            'type_id' => Yii::t('backend', 'Тип купона'),
            'object_id' => Yii::t('backend', 'Object'),
            'issued_at' => Yii::t('backend', 'Issued At'),
            'group' => Yii::t('backend', 'Group'),
            'name' => Yii::t('common', 'Name'),
            'lastname' => Yii::t('common', 'Lastname'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'Middlename'),
            'phone' => Yii::t('common', 'Phone'),
            'contractorCity' => Yii::t('common', 'City'),
            'address' => Yii::t('common', 'Address'),
            'issued_at' => Yii::t('backend', 'Issued At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'contractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject() {
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
    }

    public function getType()
    {
        return $this->hasOne(CouponType::className(), ['id' => 'type_id']);
    }

    public function getName() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->name : '';
    }

    public function getLastname() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->lastname : '';
    }

    public function getFirstname() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->firstname : '';
    }

    public function getMiddlename() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->middlename : '';
    }

    public function getPhone() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->phone : '';
    }

    public function getContractorCity() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        if ($contractor) {
            if ($contractor->city) {
                return $contractor->group->name;
            }
        }
        return "";
    }

    public function getAddress() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->address : '';
    }

    public function getGroup() {
        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        if ($contractor) {
            if ($contractor->group) {
                return $contractor->group->name;
            }
        }
        return "";
    }

    public function getContractorGroup() {
        return $this->hasOne(ContractorGroup::className(), ['id' => 'id']);
    }

    public function getCity() {
        return $this->hasOne(City::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponSolds() {
        return $this->hasMany(CouponSold::className(), ['coupon_pack_id' => 'id']);
    }
}
