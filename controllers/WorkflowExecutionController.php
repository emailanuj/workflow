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
            $workflow_elements = count((array)$workflowjson);        
            $execution_id = uniqid('ex');
            foreach($workflowjson as $wjk =>$wjv) {                                
                switch ($wjv->keywords) {
                    case "API":
                        $result = "API";
                        break;
                    case "NSO":
                        if($wjv->data_source == 'form_data') {
                            $result = $wjv->form_data;
                        } else if($wjv->data_source == 'function_name') {
                            $result = $wjv->get_data_function;                            
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
                $ex_model_saved = WorkflowExecution::find()->where(['instance_id' => $model->id, 'request_params' => $wjv->step_no, 'execution_id' => $execution_id])->one();                
                if(empty($ex_model_saved)) {                    
                    $ex_model = new WorkflowExecution(); 
                    $ex_model->instance_id      = $model->id;
                    $ex_model->request_params   = $wjv->step_no;
                    $ex_model->response_params  = $result;
                    $ex_model->execution_id     = $execution_id;  
                    $ex_model->status           = '1';              
                    $ex_model->save();                
                }                
            } 
            // get executed data  
            $execution_model = WorkflowExecution::find()->where(['instance_id' => $model->id, 'execution_id' => $execution_id])->all();            

            return $this->render('index', [                    
                'model'    => $model, 
                'execution_model' => $execution_model,               
                'workflow_id' => $id,
            ]);                          
        }                    
                      
    }
    
}
