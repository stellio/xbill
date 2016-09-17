<?php

namespace backend\modules\archivecoupons\models;

use Yii;
use yii\base\Model;
use backend\modules\archivecoupons\models\ArchiveOptions;
/**
 * This is the model class for table "archive_options".
 *
 * @property integer $id
 * @property string $param
 * @property integer $value
 */
class ArchiveMode extends Model
{
    /**
     * @inheritdoc
     */
    public static function isOn($tableName) {

      if (ArchiveOptions::get('is_archive_mode') === 1) {

          // return table name with archive index -  tablename_index
          $tableName = $tableName . "_" . ArchiveOptions::get('active_archive_id');
          return $tableName;
      } else {
        return $tableName;
      }
    }
}
