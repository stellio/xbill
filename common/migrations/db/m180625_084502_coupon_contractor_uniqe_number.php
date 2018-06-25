<?php

use yii\db\Migration;

class m180625_084502_coupon_contractor_uniqe_number extends Migration
{
   public function safeUp()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->addColumn('{{%contractor_coupon_pack}}', 'coupon_contractor_uniqe_number', $this->integer());

    }

    public function safeDown()
    {
        $this->dropColumn('{{%contractor_coupon_pack}}', 'coupon_contractor_uniqe_number');
    }
}
