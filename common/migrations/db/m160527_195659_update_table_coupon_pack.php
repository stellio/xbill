<?php

use yii\db\Migration;

class m160527_195659_update_table_coupon_pack extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->dropColumn('{{%contractor_coupon_pack}}', 'number_from');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'number_to');

        $this->addColumn('{{%contractor_coupon_pack}}', 'number_from', $this->integer());
        $this->addColumn('{{%contractor_coupon_pack}}', 'number_to', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%contractor_coupon_pack}}', 'number_from');
        $this->dropColumn('{{%contractor_coupon_pack}}', 'number_to');

        $this->addColumn('{{%contractor_coupon_pack}}', 'number_from', $this->string());
        $this->addColumn('{{%contractor_coupon_pack}}', 'number_to', $this->string());
    }
}
