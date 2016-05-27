<?php

use yii\db\Migration;

class m160527_121518_contractor extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contractor}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(32),
            'lastname' => $this->string(32)->notNull(),
            'phone' => $this->string(40)->notNull(),
            'contractor_group_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_contractor_group', '{{%contractor}}', 'contractor_group_id', '{{%contractor_group}}', 'id', 'cascade', 'set null');
    }

    public function down()
    {
        $this->dropForeignKey('fk_contractor_group', '{{%contractor}}');
        $this->dropTable('{{%contractor}}');
    }
}
