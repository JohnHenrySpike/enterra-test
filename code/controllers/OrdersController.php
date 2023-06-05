<?php

namespace app\controllers;
use app\models\Dishes;
use app\models\Orders;
use Yii;
use yii\rest\ActiveController;

use OpenApi\Attributes as OA;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends ActiveController
{
    public $modelClass = 'app\models\Orders';

    #[OA\Get(
        path: '/orders',
        tags: ['orders'],
        responses: [
            new OA\Response(
                response: 200, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties:[
                        new OA\Property(property: 'items')
                    ]
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: '/orders/{id}',
        tags: ['orders'],
        parameters: [
            new OA\Parameter('id', 'id', 'order id', 'path', true)
        ],
        responses: [
            new OA\Response(
                response: 200, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties:[
                        new OA\Property(property: 'items')
                    ]
                )
            )
        ]
    )]
    public function view(){}
    
    #[OA\Post(
        path: '/orders',
        tags: ['orders'],
        responses: [
            new OA\Response(
                response: 201, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'int', description: 'new order id'),
                    ]
                )
            )
        ]
    )]
    public function create(){}

    #[OA\Post(
        path: '/orders/append',
        tags: ['orders'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: ["order_id", "dish_id"],
                properties: [
                    new OA\Property(property: 'order_id', type: 'int'),
                    new OA\Property(property: 'dish_id', type: 'int')
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'int', description: 'dish appended'),
                    ]
                )
            )
        ]
    )]
    public function actionAppend(){
        $reqest = Yii::$app->getRequest()->getBodyParams();
        $order = Orders::findOne($reqest['order_id']);
        $dish = Dishes::findOne($reqest['dish_id']);
        $dish->link('orders', $order);
        $order->save();
        return ['dish ' . $dish['id'] . ' appended to ' . $order['id'] . ' order'];
    }
}