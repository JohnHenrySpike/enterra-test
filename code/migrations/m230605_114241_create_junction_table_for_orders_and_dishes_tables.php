<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_dishes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%orders}}`
 * - `{{%dishes}}`
 */
class m230605_114241_create_junction_table_for_orders_and_dishes_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders_dishes}}', [
            'orders_id' => $this->integer(),
            'dishes_id' => $this->integer()
        ]);

        // creates index for column `orders_id`
        $this->createIndex(
            '{{%idx-orders_dishes-orders_id}}',
            '{{%orders_dishes}}',
            'orders_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-orders_dishes-orders_id}}',
            '{{%orders_dishes}}',
            'orders_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );

        // creates index for column `dishes_id`
        $this->createIndex(
            '{{%idx-orders_dishes-dishes_id}}',
            '{{%orders_dishes}}',
            'dishes_id'
        );

        // add foreign key for table `{{%dishes}}`
        $this->addForeignKey(
            '{{%fk-orders_dishes-dishes_id}}',
            '{{%orders_dishes}}',
            'dishes_id',
            '{{%dishes}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-orders_dishes-orders_id}}',
            '{{%orders_dishes}}'
        );

        // drops index for column `orders_id`
        $this->dropIndex(
            '{{%idx-orders_dishes-orders_id}}',
            '{{%orders_dishes}}'
        );

        // drops foreign key for table `{{%dishes}}`
        $this->dropForeignKey(
            '{{%fk-orders_dishes-dishes_id}}',
            '{{%orders_dishes}}'
        );

        // drops index for column `dishes_id`
        $this->dropIndex(
            '{{%idx-orders_dishes-dishes_id}}',
            '{{%orders_dishes}}'
        );

        $this->dropTable('{{%orders_dishes}}');
    }
}
