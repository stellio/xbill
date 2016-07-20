<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\models\Contractor;

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
class CouponPack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor_coupon_pack';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),

            /*
             Disable automatical issued date set   
             [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'issued_at',
                'value' => new Expression('UNIX_TIMESTAMP(CURDATE())'),
            ]*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contractor_id', 'created_at', 'updated_at', 'number_from', 'number_to', 'sold_total', 'trip_total', 'status', 'type_id'], 'integer'],
            [['issued_at'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['issued_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['contractor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['contractor_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CouponType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'contractor_name' => Yii::t('backned', 'Название'),
            'contractor_id' => Yii::t('backend', 'Contractor'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'number_from' => Yii::t('backend', 'Number From'),
            'number_to' => Yii::t('backend', 'Number To'),
            'sold_total' => Yii::t('backend', 'Sold Total'),
            'trip_total' => Yii::t('backend', 'Trip Total'),
            'status' => Yii::t('common', 'Status'),
            'type_id' => Yii::t('backend', 'Type ID'),
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
    public function getType()
    {
        return $this->hasOne(CouponType::className(), ['id' => 'type_id']);
    }

    public function getLastname() {

        $contractor = Contractor::find()->where(['id' => $this->contractor_id])->one();
        return ($contractor) ? $contractor->lastname : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponSolds()
    {
        return $this->hasMany(CouponSold::className(), ['coupon_pack_id' => 'id']);
    }
}
