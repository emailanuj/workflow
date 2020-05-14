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

           // sort in the execution order
            $workflow_elements = (array)$workflowjson;                 
            array_walk_recursive($workflow_elements,function(&$item){if(is_object($item))$item=(array)$item;});            
            usort($workflow_elements, function($a, $b) {
                return $a['step_no'] <=> $b['step_no'];
            });
            $workflowfinaljson =  (object) json_decode(json_encode($workflow_elements));            
            // sort in the execution order

            $execution_id = uniqid('ex');            
            foreach($workflowfinaljson as $wjk =>$wjv) {                 
                // gather previous result  
                if($wjk > 0) {              
                    $previous_result = WorkflowExecution::find()->where(['id' => $ex_model->id])->one();
                    if(!empty($previous_result)) { $default_result = $previous_result->response_params; }                
                } else { $default_result = ''; }
                
                switch ($wjv->keywords) {
                    case "API":
                        $api_uri        = $wjv->api_url;
                        $api_method     = $wjv->api_method;
                        $api_type       = $wjv->api_type;
                        $api_headers    = $wjv->api_headers;
                        $auth_type      = $wjv->auth_type;
                        $token_from     = $wjv->token_from;
                        $token_url      = $wjv->token_url;
                        $username       = $wjv->username;
                        $password       = $wjv->password;

                        $post_items = array();

                        if($api_type == 'rest') {                            
                            $curl = curl_init();
                            if($api_method == 'get') {                                                                                                        
                                    curl_setopt_array($curl, [
                                        CURLOPT_RETURNTRANSFER => 1,
                                        CURLOPT_URL => $api_uri,
                                        CURLOPT_USERAGENT => 'Test'
                                    ]);
                            }
                            else if($api_method == 'post') {                                                                
                                curl_setopt_array($curl, [
                                    CURLOPT_RETURNTRANSFER => 1,
                                    CURLOPT_URL => $api_uri,
                                    CURLOPT_USERAGENT => 'Test',
                                    CURLOPT_POST => 1,
                                    CURLOPT_POSTFIELDS => $post_items
                                ]);                                
                            } else { }                            
                            $response = curl_exec($curl);
                            if($response === false)
                                { $result = curl_error($curl); }
                            else
                                { $result = $response; }                                                                  
                            curl_close($curl);
                        }                        
                        break;
                    case "NSO":
                        if($wjv->data_source == 'form_data') {
                            $result = $wjv->form_data;
                        } else if($wjv->data_source == 'function_name') {
                            $function_to_execute    = preg_split('#/#',$wjv->get_data_function);
                            //echo $ste = $function_to_execute[0].'::'.$function_to_execute[1].'()'; exit;
                            $executed_function_data = WorkflowExecution::functionex();
                            $result = $executed_function_data;                            
                        } else {
                            $result = $default_result;
                        }                        
                        break;
                    case "OTHER":
                        if($wjv->data_source == 'form_data') {
                            $result = $wjv->form_data;
                        } else if($wjv->data_source == 'function_name') {
                            $function_to_execute    = preg_split('#/#',$wjv->get_data_function);
                            //echo $ste = $function_to_execute[0].'::'.$function_to_execute[1].'()'; exit;
                            $executed_function_data = WorkflowExecution::functionex();
                            $result = $executed_function_data;                            
                        } else {
                            $result = $default_result;
                        }
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
