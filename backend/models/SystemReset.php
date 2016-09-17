<?php
namespace backend\models;

use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Create user form
 */
class SystemReset extends Model
{

    public $city;
    public $contractor;
    public $contractor_coupon_pack;
    public $contractor_group;
    public $coupon_sold;
    public $coupon_sold_numbers;
    public $coupon_type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [[
              'city',
              'contractor',
              'contractor_coupon_pack',
              'contractor_group',
              'coupon_sold',
              'coupon_sold_numbers',
              'coupon_type'
            ], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city' =>                   Yii::t('common', 'Города'),
            'contractor' =>             Yii::t('common', 'Контрагенты'),
            'contractor_coupon_pack' => Yii::t('common', 'Пачки купонов'),
            'contractor_group' =>       Yii::t('common', 'Группы контрагентов'),
            'coupon_sold' =>            Yii::t('common', 'Учет проданных купонов'),
            'coupon_sold_numbers' =>    Yii::t('common', 'Учет пробитых купонов'),
            'coupon_type' =>            Yii::t('common', 'Типы купонов'),
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function save()
    {
        $tablesNames = [];

        if ($this->validate()) {

            if ($this->contractor == 1) {
              $tablesNames[] = 'contractor';
              $tablesNames[] = 'contractor_coupon_pack';
              $tablesNames[] = 'coupon_sold';
              $tablesNames[] = 'coupon_sold_numbers';
            }

            if ($this->contractor_coupon_pack == 1) {
              $tablesNames[] = 'contractor_coupon_pack';
              $tablesNames[] = 'coupon_sold_numbers';
              $tablesNames[] = 'coupon_sold';
            }


            // return $this->createArchive($tablesNames);
            return $this->truncateTables($tablesNames);
        }
        return null;
    }


    private function createArchive($tables) {

      $connection = Yii::$app->getDb();

      foreach ($tables as $name) {
        $command = $connection->createCommand(
            "CREATE TABLE `" . $name . "_test` LIKE " . $name);
        $result = $command->execute();

      }
    }

    public function truncateTables($tableNames) {

      if (is_array($tableNames) && !empty($tableNames)) {

        $connection = Yii::$app->getDb();

        foreach($tableNames as $name) {
          $command = $connection->createCommand(
              "SET FOREIGN_KEY_CHECKS = 0;  TRUNCATE TABLE `" . $name . "`; SET FOREIGN_KEY_CHECKS = 1;");
          $result = $command->execute();
        }
        return true;
      }
      return false;
    }
}
