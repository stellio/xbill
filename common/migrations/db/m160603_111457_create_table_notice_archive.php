<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_notice_archive`.
 */
class m160603_111457_create_table_notice_archive extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notice_archive}}', [
            'id' => $this->primaryKey(),
            'msg' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%notice_archive}}');
    }
}
