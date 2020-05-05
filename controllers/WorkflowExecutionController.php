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
                //echo '<pre/>'; print_r($wjv); exit;
                switch ($wjv->keywords) {
                    case "API":
                        $result = "API";
                        break;
                    case "NSO":
                        if($wjv->data_source == 'form_data') {
                            $result = $wjv->form_data;
                        } else {
                            $result = '';
                        }                        
                        break;
                    case "OTHER":
                        $result = "OTHER";
                        break;
                    default:
                        $result = "Default";
                }
                $ex_model = new WorkflowExecution(); 
                $ex_model->instance_id      = $model->id;
                $ex_model->request_params   = $wjv->keywords;
                $ex_model->response_params  = $result;                
                $ex_model->save();                
            }  
            return $this->render('index', [                    
                'model'    => $model, 
                'ex_model' => $ex_model,               
                'workflow_id' => $id,
            ]);                          
        }                    
                      
    }
    
}
