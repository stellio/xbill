<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\modules\archivecoupons\models\ArchiveMode;
/**
 * This is the model class for table "coupon_sold".
 *
 * @property integer $id
 * @property integer $coupon_pack_id
 * @property integer $sold_count
 * @property integer $trip_count
 * @property integer $sold_at
 *
 * @property ContractorCouponPack $couponPack
 */
class CouponSold extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return ArchiveMode::isOn('coupon_sold');
    }

    /*
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'sold_at',
                'updatedAtAttribute' => null,
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
            [['coupon_pack_id', 'sold_count', 'trip_count', 'sold_at'], 'integer'],
            [['coupon_pack_id'], 'exist', 'skipOnError' => true, 'targetClass' => CouponPack::className(), 'targetAttribute' => ['coupon_pack_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'coupon_pack_id' => Yii::t('backend', 'Coupon Pack ID'),
            'sold_count' => Yii::t('backend', 'Sold Count'),
            'trip_count' => Yii::t('backend', 'Trip Count'),
            'sold_at' => Yii::t('backend', 'Sold At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponPack()
    {
        return $this->hasOne(ContractorCouponPack::className(), ['id' => 'coupon_pack_id']);
    }
}
