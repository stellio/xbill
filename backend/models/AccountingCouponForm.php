<?php
namespace backend\models;

use cheatsheet\Time;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

/**
 * Login form
 */
class AccountingCouponForm extends Model
{
    public $numbers;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numbers'], 'required'],
            [['numbers'], 'string', 'max' => 130],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'numbers' => Yii::t('backend', 'Coupon Numbers')
        ];
    }
}
