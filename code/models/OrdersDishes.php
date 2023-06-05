<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_dishes".
 *
 * @property int|null $orders_id
 * @property int|null $dishes_id
 *
 * @property Dishes $dishes
 * @property Orders $orders
 */
class OrdersDishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orders_id', 'dishes_id'], 'integer'],
            [['orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::class, 'targetAttribute' => ['orders_id' => 'id']],
            [['dishes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::class, 'targetAttribute' => ['dishes_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orders_id' => 'Orders ID',
            'dishes_id' => 'Dishes ID',
        ];
    }

    /**
     * Gets query for [[Dishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasOne(Dishes::class, ['id' => 'dishes_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::class, ['id' => 'orders_id']);
    }
}
