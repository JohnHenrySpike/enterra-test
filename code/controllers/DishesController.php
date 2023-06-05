<?php

namespace app\controllers;

use yii\rest\ActiveController;

use OpenApi\Attributes as OA;

/**
 * DishesController implements the CRUD actions for Dishes model.
 */
class DishesController extends ActiveController
{
    public $modelClass = 'app\models\Dishes';

    #[OA\Get(
        path: '/dishes',
        tags: ['dishes'],
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

    #[OA\Post(
        path: '/dishes',
        tags: ['dishes'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: ["name", "chef_id"],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'chef_id', type: 'int')
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201, 
                description: 'OK',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'int', description: 'new dish id'),
                    ]
                )
            )
        ]
    )]
    public function create(){}
    
}
