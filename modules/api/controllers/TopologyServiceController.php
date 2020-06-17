<?php

namespace app\modules\api\controllers;
use linslin\yii2\curl;

class TopologyServiceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //https://jsonplaceholder.typicode.com/todos/

        

        $curl = new curl\Curl();
        $response = $curl->get('https://jsonplaceholder.typicode.com/todos/');
        // echo '<pre>'; print_r($response);

        return $this->render('index');
    }
}
