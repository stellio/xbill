<?php

use yii\db\Migration;

class m160529_190935_update_table_contractor extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('{{%contractor}}', 'middlename', $this->string());
        $this->addColumn('{{%contractor}}', 'note', $this->string());
        $this->addColumn('{{%contractor}}', 'name', $this->string());
        $this->addColumn('{{%contractor}}', 'address', $this->string());
        $this->addColumn('{{%contractor}}', 'city_id', $this->integer());

        $this->addForeignKey('fk_city', '{{%contractor}}', 'city_id', '{{%city}}', 'id', 'cascade', 'set null');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_city', '{{%contractor}}');

        $this->dropColumn('{{%contractor}}', 'middlename');
        $this->dropColumn('{{%contractor}}', 'note');
        $this->dropColumn('{{%contractor}}', 'name');
        $this->dropColumn('{{%contractor}}', 'address');
        $this->dropColumn('{{%contractor}}', 'city_id');
    }
}
