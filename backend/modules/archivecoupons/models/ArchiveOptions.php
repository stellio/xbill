<?php

namespace backend\modules\archivecoupons\models;

use Yii;

/**
 * This is the model class for table "archive_options".
 *
 * @property integer $id
 * @property string $param
 * @property integer $value
 */
class ArchiveOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'archive_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
            [['param'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'param' => Yii::t('common', 'Param'),
            'value' => Yii::t('common', 'Value'),
        ];
    }


    public static function get($param) {

        $model = ArchiveOptions::findOne(['param' => $param]);
        if ($model) {
          return $model->value;
        }

        return false;
    }

    public static function set($param, $value) {

        $model = ArchiveOptions::findOne(['param' => $param]);
        // if ($model) {
        $model->value = $value;
        $status = $model->update();
        return $status;
    }

}
