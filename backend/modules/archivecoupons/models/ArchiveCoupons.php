<?php

namespace backend\modules\archivecoupons\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "archive_coupons".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ArchiveOptions[] $archiveOptions
 */
class ArchiveCoupons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'archive_coupons';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArchiveOptions()
    {
        return $this->hasMany(ArchiveOptions::className(), ['active_archive_id' => 'id']);
    }
}
