<?php

namespace backend\models;

use Yii;
use backend\modules\archivecoupons\models\ArchiveMode;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Contractor[] $contractors
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        // check if Archive mode is "On"
        // if "On" - return table name with archive index (tablename_index)
        // if "Off" - return current table name
        return ArchiveMode::isOn('city');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['city_id' => 'id']);
    }
}
