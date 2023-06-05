<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property string $name
 * @property int $chef_id
 *
 * @property Chefs $chef
 * @property Orders[] $orders
 * @property OrdersDishes[] $ordersDishes
 */
class Dishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'chef_id'], 'required'],
            [['chef_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['chef_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chefs::class, 'targetAttribute' => ['chef_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'chef_id' => 'Chef ID',
        ];
    }

    /**
     * Gets query for [[Chef]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChef()
    {
        return $this->hasOne(Chefs::class, ['id' => 'chef_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id' => 'orders_id'])->viaTable('orders_dishes', ['dishes_id' => 'id']);
    }

    /**
     * Gets query for [[OrdersDishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersDishes()
    {
        return $this->hasMany(OrdersDishes::class, ['dishes_id' => 'id']);
    }
}