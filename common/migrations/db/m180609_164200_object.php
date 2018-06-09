<?php

use yii\db\Migration;

class m180609_164200_object extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%object}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string(1024),
      ], $tableOptions);

      $this->addColumn('{{%contractor_coupon_pack}}', 'object_id', $this->integer());
      $this->addForeignKey('fk_object', '{{%contractor_coupon_pack}}', 'object_id', '{{%object}}', 'id', 'cascade', 'cascade');

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_object', '{{%contractor_coupon_pack}}');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'object_id');
        
        $this->dropTable('{{%object}}'); 
    }
}
