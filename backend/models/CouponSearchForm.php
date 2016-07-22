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
class CouponSearchForm extends Model
{

    public $number;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('backend', 'Coupon Number')
        ];
    }

    public function enterNumbers() {

        return false;
    }
}
