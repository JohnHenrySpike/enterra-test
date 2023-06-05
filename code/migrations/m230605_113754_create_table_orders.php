<?php

use yii\db\Migration;

/**
 * Class m230605_113754_create_table_orders
 */
class m230605_113754_create_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230605_113754_create_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
