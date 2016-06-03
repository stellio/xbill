<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class NoticeForm extends Model
{
    public $msg;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msg' => Yii::t('backend', 'Message')
        ];
    }
}
