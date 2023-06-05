<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class DocsController extends Controller
{
    public function actionIndex()
    {
        $openapi = \OpenApi\Generator::scan([Yii::getAlias('@app/controllers')]);
        $file = Yii::getAlias('@app/web').'/swagger.json';
        $handle = fopen($file, 'wb');
        fwrite($handle, $openapi->toJson());
        fclose($handle);
        $this->stdout("[ docs ] refreshed \n", Console::FG_GREEN);
        return 0;
    }
}
