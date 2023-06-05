<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230605_111555_create_table_chefs
 */
class m230605_111555_create_table_chefs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chefs', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chefs');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230605_111555_create_table_chefs cannot be reverted.\n";

        return false;
    }
    */
}
