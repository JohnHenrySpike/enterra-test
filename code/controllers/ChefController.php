<?php

namespace app\controllers;

use app\models\Chefs;
use app\models\Dishes;
use app\models\Orders;
use yii\db\Query;
use yii\rest\ActiveController;

use OpenApi\Attributes as OA;

/**
 * ChefController implements the CRUD actions for Chefs model.
 */
class ChefController extends ActiveController
{
    public $modelClass = 'app\models\Chefs';

    #[OA\Get(
        path: '/chef',
        tags: ['chef'],
        responses: [
            new OA\Response(
                response: 200, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties:[
                        new OA\Property(property: 'items'),
                    ]
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: '/chef/top?from={from}&to={to}',
        tags: ['chef'],
        parameters: [
            new OA\Parameter('from', 'from', 'from date', 'path', true, examples: [
                new OA\Examples("date from", "date from", value: "2023-01-01 00:00:00")
            ]),
            new OA\Parameter('to', 'to', 'to date', 'path', true, examples: [
                new OA\Examples("date to", "date to", value: "2023-12-31 23:59:59")
            ])
        ],
        responses: [
            new OA\Response(
                response: 200, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties:[
                        new OA\Property(property: 'items'),
                    ]
                )
            )
        ]
    )]
    public function actionTop(){

        $form = new \app\models\forms\ChefsTopForm();
        $form->load(\Yii::$app->request->get());
        if (!$form->validate()) {
            \Yii::$app->response->statusCode = 400;
            return $form->getErrors();
        }

        $query = new Query;

        return $query
            ->select(["chef_id", "chefs.name", "COUNT(*) as ordered_dishes",])
            ->from(Orders::tableName())
            ->where(['between', 'date', $form->from, $form->to])
            ->innerJoin('orders_dishes', 'orders.id = orders_id')
            ->innerJoin(Dishes::tableName(), "dishes.id = orders_dishes.dishes_id")
            ->rightJoin(Chefs::tableName(), "chef_id = chefs.id")
            ->groupBy("chef_id")
            ->orderBy(["ordered_dishes" => SORT_DESC])
            ->all();
    }

    #[OA\Post(
        path: '/chef',
        tags: ['chef'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: ["name"],
                properties: [
                    new OA\Property(property: 'name', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'int', description: 'new chef id'),
                    ]
                )
            )
        ]
    )]
    public function create(){}
}
