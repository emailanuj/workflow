<?php

namespace app\controllers;

use Yii;
use app\models\WorkflowExecution;
use app\models\WorkflowExecutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Workflow;

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

    public function actionIndex() { 
        $this->layout = 'workflowLayout';               
        $id = Yii::$app->request->get('id');        
        if (($model = Workflow::findOne($id)) !== null) {
            $workflowjson = json_decode($model->workflow_data);
            foreach($workflowjson as $wjk =>$wjv) {
                                        //(
                                        //     [step_no] => 12
                                        //     [if_fail] => stop
                                        //     [next_process] => 1
                                        //     [keywords] => NSO
                                        //     [api_url] => 
                                        //     [api_method] => 
                                        //     [api_type] => 
                                        //     [api_headers] => 
                                        //     [function_execute] => 
                                        //     [auth_type] => 
                                        //     [token_from] => 
                                        //     [token_url] => 
                                        //     [username] => 
                                        //     [password] => 
                                        //     [data_source] => form_data
                                        //     [get_data_function] => 
                                        //     [form_data] => form data
                                        // )
                switch ($wjv->keywords) {
                    case "API":
                        $result = "API";
                        break;
                    case "NSO":
                        //$wjv->
                        $result = "NSO";
                        break;
                    case "OTHER":
                        $result = "OTHER";
                        break;
                    default:
                        $result = "Default";
                }
            }  
            return $this->render('index', [                    
                'model'    => $model,                
                'workflow_id' => $id,
            ]);                          
        }                    
                      
    }
    
}
