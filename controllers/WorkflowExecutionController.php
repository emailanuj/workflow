<?php

namespace app\controllers;

use Yii;
use app\models\WorkflowExecution;
use app\models\WorkflowExecutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Workflow;
use yii\data\ActiveDataProvider;
use yii\db\Query;


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
            return $this->render('index', [                    
                'model'    => $model,
                'workflow_id' => $id,
            ]);                          
        }
    }

    public function actionGetRunningProcess() { 
        $model = Workflow::findOne(Yii::$app->request->post('workflow-id'));
        $workflowjson = json_decode($model->workflow_data,true);
        // echo '<pre>'; print_r($workflowjson); __LINE__;die;
        $arrToRunProcess = array_keys($workflowjson);

        $execution_id = uniqid('ex');

        $arrOutput = [];
        foreach ($arrToRunProcess as $strIndex => $strValue) {
            $arrOutput[$strIndex]['execution_id'] = $execution_id;
            $arrOutput[$strIndex]['diagram_id'] = $strValue;
        }

        return json_encode($arrOutput);
    }


    public function actionExecuteRunningProcess() { 
        // process 1

        // sucess or failer

        // $model = Workflow::findOne(Yii::$app->request->post('workflow-id'));
        // $workflowjson = json_decode($model->workflow_data,true);
        // // echo '<pre>'; print_r($workflowjson); __LINE__;die;
        // $arrToRunProcess = array_keys($workflowjson);
        // return json_encode($arrToRunProcess);
    }


    public function actionIndexBackup() { 
        $this->layout = 'workflowLayout';               
        $id = Yii::$app->request->get('id');
        if (($model = Workflow::findOne($id)) !== null) {

            $workflowjson = json_decode($model->workflow_data);
            $workflowdiagramjson = json_decode($model->workflow_json); 
            $workflowdiagram_finaljson = json_decode(json_encode($workflowdiagramjson->bpmn), true);
           // sort in the execution order
            $workflow_elements = json_decode(json_encode($workflowjson), true);                                                    
            //usort($workflow_elements, function($a, $b) { return $a['step_no'] <=> $b['step_no']; });            
            $workflowfinaljson =  (object) json_decode(json_encode($workflow_elements));                                 
            // sort in the execution order

            $execution_id = uniqid('ex');
            $ex_id = 0;            
            foreach($workflowfinaljson as $workflow_key =>$workflow_values) {                 
                // gather previous result  
                if($ex_id > 0) {              
                    $previous_result = WorkflowExecution::find()->where(['id' => $ex_model->id])->one();
                    if(!empty($previous_result)) { $default_result = $previous_result->response_params; }                
                } else { $default_result = ''; }
                
                switch ($workflow_values->keywords) {
                    case "API":
                        $api_uri        = $workflow_values->api_url;
                        $api_method     = $workflow_values->api_method;
                        $api_type       = $workflow_values->api_type;
                        $api_headers    = $workflow_values->api_headers;
                        $auth_type      = $workflow_values->auth_type;
                        $token_from     = $workflow_values->token_from;
                        $token_url      = $workflow_values->token_url;
                        $username       = $workflow_values->username;
                        $password       = $workflow_values->password;

                        $token_bearer = $this->getCurrentToken($auth_type,$token_url,$username,$password,$execution_id);                        
                        $post_items = array();

                        if($api_type == 'rest') {                            
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    'Authorization: Bearer ' . $token_bearer
                                    )); 
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
                        if($workflow_values->data_source == 'form_data') {
                            $result = $workflow_values->form_data;
                        } else if($workflow_values->data_source == 'function_name') {
                            $function_to_execute    = preg_split('#/#',$workflow_values->get_data_function);
                            //echo $ste = $function_to_execute[0].'::'.$function_to_execute[1].'()'; exit;
                            $executed_function_data = WorkflowExecution::functionex();
                            $result = $executed_function_data;                            
                        } else {
                            $result = $default_result;
                        }                        
                        break;
                    case "OTHER":
                        if($workflow_values->data_source == 'form_data') {
                            $result = $workflow_values->form_data;
                        } else if($workflow_values->data_source == 'function_name') {
                            $function_to_execute    = preg_split('#/#',$workflow_values->get_data_function);
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
                $execution_model_saved = WorkflowExecution::find()->where(['instance_id' => $model->id, 'request_params' => $workflow_values->step_no, 'execution_id' => $execution_id])->one();                
                if(empty($execution_model_saved)) {                                       
                    $ex_model = new WorkflowExecution(); 
                    $ex_model->instance_id      = $model->id;
                    $ex_model->request_params   = $workflow_values->step_no;
                    $ex_model->response_params  = $result;
                    $ex_model->execution_id     = $execution_id; 
                    if($workflow_values->keywords == 'API') {
                        $ex_model->api_domain       = $token_url;
                        $ex_model->auth_token       = $token_bearer; 
                    }                    
                    $ex_model->status  = empty($result) ? '0' : '1';                                                  
                    $ex_model->save();                
                } 
                $workflow_key = ltrim($workflow_key,"SE");                
                $jsonkey = array_search($workflow_key,array_column($workflowdiagram_finaljson, 'id'));
                $workflowdiagram_finaljson[$jsonkey]['status'] = empty($result) ? '0' : '1';                  
                if(empty($result)) { if($workflow_values->if_fail == 'stop') { break;  } }
                              
               $ex_id++;                         
            }  
            $workflowdiagrambpmn['bpmn'] = $workflowdiagram_finaljson;
            $workflow_json_diagram_save = json_encode($workflowdiagrambpmn);           
            $model->workflow_json = $workflow_json_diagram_save;           
            $model->save();                    
            // get executed data  
            //$dataProvider = WorkflowExecution::find()->where(['instance_id' => $model->id, 'execution_id' => $execution_id])->all();                       
            $query = (new Query())->from('workflow_execution')->where(['instance_id' => $model->id, 'execution_id' => $execution_id]);                        
            $provider = new ActiveDataProvider([
                'query' => $query,                
                'sort' => [
                    'defaultOrder' => [
                        //'created_at' => SORT_DESC,
                        //'request_params' => SORT_ASC, 
                    ]
                ],
            ]);
            $emodel = $provider->getModels();
            // get executed data 
            return $this->render('index', [                    
                'model'    => $model, 
                'dataProvider' => $provider, 
                'emodel'     => $emodel,              
                'workflow_id' => $id,
            ]);                          
        }                    
                      
    }

    public function getCurrentToken($auth_type,$token_url,$username,$password,$executionid) {
        $credentials = array('username' => $username, 'password' => $password);                    
        if($auth_type == 'token') { 
            $previous_token = WorkflowExecution::find()->where(['execution_id' => $executionid, 'api_domain' => $token_url])->one();
            if(!empty($previous_token)) {
                $token = $previous_token->auth_token;
                return $token;
            }
            else {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $token_url,
                    CURLOPT_USERAGENT => 'Test',
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $credentials
                ]);
                $response = curl_exec($curl);            
                if($response === false)
                    { $token = curl_error($curl); }
                else
                    { $token = $response; }                                                                  
                curl_close($curl);            
                return $token;
            }
        }
    }

    public function actionList() {

    }
    
}
