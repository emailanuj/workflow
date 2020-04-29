<?php

namespace app\controllers;

use Yii;
use app\models\WorkflowExecution;
use app\models\WorkflowExecutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkflowExecutionController implements the CRUD actions for WorkflowExecution model.
*/
class WorkflowExecutionController extends Controller
{
    /**
     * {@inheritdoc}
    */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function execute() {
            // case 1:  API
            // case 2: Other
            //     check Data_Source 
            //           case 1:  form_data
            //           case2: Function to get data
            //           case3: From Previous Process:  get all process selected from 
            //           case 4 : check if complete workflow's data is given            
                      
    }
    
}
