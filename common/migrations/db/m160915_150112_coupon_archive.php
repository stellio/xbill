<?php

use yii\db\Migration;

class m160915_150112_coupon_archive extends Migration
{
  // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%archive_coupons}}', [
          'id' => $this->primaryKey(),
          'title' => $this->string(1024),
          'created_at' => $this->integer(),
          'updated_at' => $this->integer(),
      ], $tableOptions);

      $this->createTable('{{%archive_options}}', [
          'id' => $this->primaryKey(),
          'param' => $this->string(1024),
          'value' => $this->integer(),
      ], $tableOptions);

      $this->batchInsert(
          '{{%archive_options}}',
          ['param', 'value'],
          [
              ['is_archive_mode', 0],
              ['active_archive_id', 0],
          ]
      );

    }



    public function safeDown()
    {
      $this->dropTable('{{%archive_coupons}}');
      $this->dropTable('{{%archive_options}}');
    }
}
