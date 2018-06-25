<?php
namespace backend\models;

use cheatsheet\Time;
use common\models\User;
use backend\CouponPack;
use backend\CouponSold;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

/**
 * Login form
 */
class ContractorNumberForm extends Model
{
    public $coupon_contractor_uniqe_number;
    public $number_of_sold;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number_of_sold', 'coupon_contractor_uniqe_number'], 'required'],
            [['number_of_sold', 'coupon_contractor_uniqe_number'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number_of_sold' => Yii::t('backend', 'Количество проданных'),
            'coupon_contractor_uniqe_number' => Yii::t('backend', 'Уникальный назначенный номер пачки купонов для агента')
        ];
    }

    public function enterNumbers() {

        return false;
    }
}
