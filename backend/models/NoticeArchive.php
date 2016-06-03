<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notice_archive".
 *
 * @property integer $id
 * @property integer $msg
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class NoticeArchive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_archive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'msg' => Yii::t('backend', 'Msg'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
