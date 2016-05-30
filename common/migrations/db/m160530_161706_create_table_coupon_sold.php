<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_coupon_sold`.
 */
class m160530_161706_create_table_coupon_sold extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%coupon_sold}}', [
            'id' => $this->primaryKey(),
            'coupon_pack_id' => $this->integer(),
            'sold_count' => $this->integer()->defaultValue(0),
            'trip_count' => $this->integer()->defaultValue(0),
            'sold_at'    => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_pack', '{{%coupon_sold}}', 'coupon_pack_id', '{{%contractor_coupon_pack}}', 'id', 'cascade', 'set null');
    }

    public function down()
    {
        $this->dropForeignKey('fk_pack', '{{%coupon_sold}}');
        $this->dropTable('{{%coupon_type}}');
    }
}
