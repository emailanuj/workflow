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
use kartik\export\ExportMenu;
use kartik\grid\GridView;



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

    public function getExecutionTable($instanceId,$executionId) {
        $query = (new Query())->from(WorkflowExecution::tableName())->where(['instance_id' => $instanceId, 'execution_id' => $executionId]);                        
            $dataProvider = new ActiveDataProvider([
                'query' => $query,                
                'sort' => [
                    'defaultOrder' => [
                        //'created_at' => SORT_DESC,
                        //'request_params' => SORT_ASC, 
                    ]
                ],
            ]);
            $executionModel = $dataProvider->getModels();            

            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],
            
                'id',            
                'request_params',
                'response_params',
                'created_at:datetime',
                'updated_at:datetime',                       
                [
                  'label'=>'Status',
                  'format'=>'raw',
                  'value' => function($executionModel) { 
                    if($executionModel['status'] == 1) { $tablerowstatus = 'In Progress'; }
                    else if($executionModel['status'] == 2) { $tablerowstatus = 'Pass'; }
                    else if($executionModel['status'] == 3) { $tablerowstatus = 'Fail'; }
                    else { $tablerowstatus = 'Not Started'; }
                    return $tablerowstatus;
                  }, 
                 ],
                ['class' => 'yii\grid\ActionColumn', 'template' => ''],
                ];
              return GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
            ]);
            
    }

    public function diagramStatusChange($workflowDiagram,$status,$diagramId) {                        
        $workflow_key = ltrim($diagramId,"SE");                
        $jsonkey = array_search($workflow_key,array_column($workflowDiagram, 'id'));
        $workflowDiagram[$jsonkey]['status'] = $status;
        $workflowDiagramBpmn['bpmn'] = $workflowDiagram;
        $workflowDiagramBpmnJson = json_encode($workflowDiagramBpmn);        
        return $workflowDiagramBpmnJson;
    }

    public function actionGetRunningProcess() { 
        $model = Workflow::findOne(Yii::$app->request->post('workflow-id'));        
        $output = $this->preExecutionSave($model);
        $executionId = reset($output);
        $executionModelData = $this->getExecutionTable($model->id,$executionId);
        $output['datatable'] = $executionModelData;
        return json_encode($output);
    }    

    public function preExecutionSave($model) {
        $workflowData = json_decode($model->workflow_data,true);
        uasort($workflowData, function($a, $b) {
            return $a['step_no'] <=> $b['step_no'];
        });        
        $workflowDiagram = json_decode($model->workflow_json,true);
        $workflowDiagram = $workflowDiagram['bpmn'];
        $data = array();
        $executionId = uniqid('ex');              
        foreach($workflowData as $dataKey => $dataValue) {
            $processStatus = WorkflowExecution::IN_PROGRESS;            
            $workflowDiagramBpmnJson = $this->diagramStatusChange($workflowDiagram,$processStatus,$dataKey); 
            $data[] = [$model->id,$dataKey,$executionId,WorkflowExecution::IN_PROGRESS,$workflowDiagramBpmnJson, time()]; 
            $output[$dataKey] = $executionId;                                             
        }

        $arrTableColumn = ['instance_id','request_params', 'execution_id','status','workflow_diagram','created_at'];
        $executionCount = Yii::$app->db->createCommand()
                            ->batchInsert(WorkflowExecution::tableName(), $arrTableColumn ,$data)->execute();


        return $output;
    }



    public function actionExecuteRunningProcess() { 
         $model = Workflow::findOne(Yii::$app->request->post('workflow-id'));
         $diagramId = Yii::$app->request->post('diagram-id');
         $gatewayId = preg_replace('/[0-9]+/', '', $diagramId);         
         $executionId = Yii::$app->request->post('execution-id');
                  
         $workflowData = json_decode($model->workflow_data,true);                  
         $workflowExecutableData = $workflowData[$diagramId];
         
         $nextStep = $workflowExecutableData['next_process'];
         $currentStep = $workflowExecutableData['step_no'];

        /* check stepwise execution and diagram creation */
        $workflowDiagramData = Yii::$app->db->createCommand("SELECT response_params,next_step,workflow_diagram FROM tbl_workflow_execution WHERE instance_id = '".$model->id."' AND execution_id = '".$executionId."' ORDER BY updated_at DESC")->queryOne();
        if(!empty($workflowDiagramData)) { 
            $workflowDiagramExecute = $workflowDiagramData['workflow_diagram'];
            $workflowStepToExecute =   $workflowDiagramData['next_step']; 
            $previousResponse =     $workflowDiagramData['response_params'];     
            if(!empty($workflowDiagramExecute)) { $workflowDiagram  = json_decode($workflowDiagramExecute, true); }
        } else {
            $workflowDiagram = json_decode($model->workflow_json,true);
        }                  
        $workflowDiagram = $workflowDiagram['bpmn'];
        if(!empty($workflowStepToExecute)) { if($currentStep !== $workflowStepToExecute) { $output = 'blank'; return json_encode($output);  } }
        
        if(strpos($gatewayId, 'PGgateway') !== 0) {         
        switch ($workflowExecutableData['keywords']) {
            case "API":
                $apiUrl        = $workflowExecutableData['api_url'];
                $apiMethod     = $workflowExecutableData['api_method'];
                $apiType       = $workflowExecutableData['api_type'];
                $apiHeaders    = $workflowExecutableData['api_headers'];
                $authType      = $workflowExecutableData['auth_type'];
                $tokenFrom     = $workflowExecutableData['token_from'];
                $tokenUrl      = $workflowExecutableData['token_url'];
                $username      = $workflowExecutableData['username'];
                $password      = $workflowExecutableData['password'];

                $tokenBearer = $this->getCurrentToken($authType,$tokenUrl,$username,$password,$executionId);                        
                $post_items = array();

                if($apiType == 'rest') {                            
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            'Authorization: Bearer ' . $tokenBearer
                            )); 
                    if($apiMethod == 'get') {                                                                                                                                           
                            curl_setopt_array($curl, [
                                CURLOPT_RETURNTRANSFER => 1,
                                CURLOPT_URL => $apiUrl,
                                CURLOPT_USERAGENT => 'Test'
                            ]);                                    
                    }
                    else if($apiMethod == 'post') {                                                                
                        curl_setopt_array($curl, [
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_URL => $apiUrl,
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
                if($workflowExecutableData['data_source'] == 'form_data') {
                    $result = $workflowExecutableData['form_data'];
                } else if($workflowExecutableData['data_source'] == 'function_name') {
                    $functionToExecute    = preg_split('#/#',$workflowExecutableData['get_data_function']);
                    //echo $ste = $function_to_execute[0].'::'.$function_to_execute[1].'()'; exit;
                    $executedFunctionData = WorkflowExecution::functionex();
                    $result = $executedFunctionData;                            
                } else {
                    $result = $previousResponse;
                }                        
                break;
            case "OTHER":
                if($workflowExecutableData['data_source'] == 'form_data') {
                    $result = $workflowExecutableData['form_data'];
                } else if($workflowExecutableData['data_source'] == 'function_name') {
                    $functionToExecute    = preg_split('#/#',$workflowExecutableData['get_data_function']);
                    //echo $ste = $function_to_execute[0].'::'.$function_to_execute[1].'()'; exit;
                    $executedFunctionData = WorkflowExecution::functionex();
                    $result = $executedFunctionData;                            
                } else {
                    $result = $previousResponse;
                } 
                break;
            default:
                $result = "Default";
         }
        } else {
            if($workflowExecutableData['condition_statement'] == $previousResponse) {
                $nextStep = $workflowExecutableData['next_process'];
                $result = 'condition executed';
            } else {
                $result = '';
            }           
        }

         $processStatus   = empty($result) ? WorkflowExecution::FAIL : WorkflowExecution::PASS;
         $workflowDiagramBpmnJson = $this->diagramStatusChange($workflowDiagram,$processStatus,$diagramId);         
         $executionModelArr = array();
         $executionModel = WorkflowExecution::findOne(['request_params' => $diagramId, 'execution_id' => $executionId]);                  
         $executionModel->response_params  = $result;             
            if((@$workflowExecutableData['keywords'] == 'API') && strpos($gatewayId, 'PGgateway') !== 0) {
                $executionModel->api_domain       = $tokenUrl;
                $executionModel->auth_token       = $tokenBearer; 
            }             
            $executionModel->workflow_diagram = $workflowDiagramBpmnJson;
            $executionModel->next_step = $nextStep;                   
            $executionModel->status  = empty($result) ? WorkflowExecution::FAIL : WorkflowExecution::PASS;
            $executionModel->save();            

            /* save diagram to sync all */
            Yii::$app->db->createCommand()
            ->update('tbl_workflow_execution', ['workflow_diagram' => $workflowDiagramBpmnJson], ['instance_id' => $model->id, 'execution_id' => $executionId])
            ->execute();
            
            $executionModelData = $this->getExecutionTable($model->id,$executionId);
            $output['status']   = empty($result) ? WorkflowExecution::FAIL : WorkflowExecution::PASS;
            $output['datatable'] = $executionModelData;
            return json_encode($output);
        
    }

    public function getCurrentToken($authType,$tokenUrl,$username,$password,$executionId) {
        $credentials = array('username' => $username, 'password' => $password);                    
        if($authType == 'token') { 
            $previousToken = WorkflowExecution::find()->where(['execution_id' => $executionId, 'api_domain' => $tokenUrl])->one();
            if(!empty($previousToken)) {
                $token = $previousToken->auth_token;
                return $token;
            }
            else {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $tokenUrl,
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

    public function actionIndexBackup() { 
        foreach($workflowfinaljson as $workflow_key =>$workflow_values) {                 
            // gather previous result  
            if($ex_id > 0) {              
                $previous_result = WorkflowExecution::find()->where(['id' => $ex_model->id])->one();
                if(!empty($previous_result)) { $default_result = $previous_result->response_params; }                
            } else { $default_result = ''; }                                                                                                  
    }                    
                  
}
    
}
