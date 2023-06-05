<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string|null $date
 *
 * @property Dishes[] $dishes
 * @property OrdersDishes[] $ordersDishes
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
        ];
    }

    public function fields()
    {
        return ['id', 'date', 'allDishes'];
    }
    
    /**
     * Gets query for [[Dishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dishes::class, ['id' => 'dishes_id'])->viaTable('orders_dishes', ['orders_id' => 'id']);
    }

    /**
     * Gets query for [[Dishes]].
     *
     * //@return \yii\db\ActiveQuery
     */
    public function getAllDishes()
    {   
        $query = new Query;
        return $query
            ->select(["id", "name", "COUNT(*) as cnt"])
            ->from('orders_dishes')
            ->where(['orders_id' => $this->id])
            ->innerJoin(Dishes::tableName(), 'dishes.id = dishes_id')
            ->groupBy("id")->all();
    }

    /**
     * Gets query for [[OrdersDishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersDishes()
    {
        return $this->hasMany(OrdersDishes::class, ['orders_id' => 'id']);
    }
}