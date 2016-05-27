<?php

use yii\db\Migration;

class m160527_121522_contractor_coupon_pack extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contractor_coupon_pack}}', [
            'id' => $this->primaryKey(),
            'contractor_id' => $this->integer(),
            'number_from' => $this->string(),
            'number_to' => $this->string(),
            'used_count' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_contractor', '{{%contractor_coupon_pack}}', 'contractor_id', '{{%contractor}}', 'id', 'cascade', 'set null');
    }

    public function down()
    {
        $this->dropForeignKey('fk_contractor', '{{%contractor_coupon_pack}}');
        $this->dropTable('{{%contractor_coupon_pack}}');
    }
}
