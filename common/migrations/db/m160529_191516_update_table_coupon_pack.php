<?php

use yii\db\Migration;

class m160529_191516_update_table_coupon_pack extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->dropColumn('{{%contractor_coupon_pack}}', 'used_count');

        $this->addColumn('{{%contractor_coupon_pack}}', 'sold_total', $this->integer()->defaultValue(0));
        $this->addColumn('{{%contractor_coupon_pack}}', 'trip_total', $this->integer()->defaultValue(0));
        $this->addColumn('{{%contractor_coupon_pack}}', 'status', $this->integer()->defaultValue(0));
        $this->addColumn('{{%contractor_coupon_pack}}', 'type_id', $this->integer());
        $this->addColumn('{{%contractor_coupon_pack}}', 'issued_at', $this->integer());

        $this->addForeignKey('fk_type', '{{%contractor_coupon_pack}}', 'type_id', '{{%coupon_type}}', 'id', 'cascade', 'cascade');
    }

    public function safeDown()
    {
        $this->addColumn('{{%contractor_coupon_pack}}', 'used_count', $this->integer());
        $this->dropForeignKey('fk_type', '{{%contractor_coupon_pack}}');

        $this->dropColumn('{{%contractor_coupon_pack}}', 'sold_total');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'trip_total');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'status');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'type_id');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'issued_at');
    }
}
