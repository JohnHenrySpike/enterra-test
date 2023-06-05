<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230605_112101_create_table_dishes
 */
class m230605_112101_create_table_dishes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dishes', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'chef_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-dishes-chef_id',
            'dishes',
            'chef_id',
            'chefs',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-dishes-chef_id',
            'dishes'
        );

        $this->dropTable('dishes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230605_112101_create_table_dishes cannot be reverted.\n";

        return false;
    }
    */
}
