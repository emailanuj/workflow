<?php

namespace app\controllers;

use Yii;
use app\models\Workflow;
use app\models\MongoWorkFlow;
use app\models\WorkflowClone;
use app\models\WorkflowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\models\WorkflowDataModel;
use app\models\WorkflowStartEventModel;
use app\models\TblFunctions;
use app\models\TblKeywords;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * WorkflowController implements the CRUD actions for Workflow model.
 */
class WorkflowController extends Controller
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

    /**
     * Lists all Workflow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $workflowModel=new Workflow();
        $searchModel = new WorkflowSearch();        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $clonemodel = new WorkflowClone();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'workflowModel'=>$workflowModel,
            'clonemodel' => $clonemodel,
        ]);
    }

    /**
     * Displays a single Workflow model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Workflow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {
        $this->layout = 'workflowLayout';
        $post_data='';
        $model = new Workflow();
        
        $workflowDataModel = new WorkflowDataModel();

        if(!empty(Yii::$app->request->post())){

            $post_data=Yii::$app->request->post();        
            if ($model->load($post_data) && $model->save()) {
                $post_data=Yii::$app->request->post();
                /* -------------------- For Updating Records in MongoDB ------------------------------*/
                $session_id=Yii::$app->session->Id;
                try{
                    $logged_in_user_id=Yii::$app->user->identity->id;
                }
                catch (\Exception $ex){
                    $logged_in_user_id='';
                }
                /* ------------------------ End ------------------------------------------------------*/
                return $this->redirect(['create', 'id' => $model->id]);
            }
        }
        if(!empty($id)){
            $model = $this->findModel($id);
        }
        $title=$model['workflow_title'];
        return $this->render('create', [
            'model' => $model,
            'workflowDataModel' => $workflowDataModel,
            'workflow_id'=>$id
        ]);
    }



    public function actionGetAjaxForm()
    {
        $workflowStartEventModel = new WorkflowStartEventModel();
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost ){
            
            $strFormType=Yii::$app->request->post('form_type');
            $element_id=Yii::$app->request->post('element_id');
            $workflow_id=Yii::$app->request->post('workflow_id');
            $arrOutputForm = [];
            $arrOutputForm['status'] = 'success';
            //if( $strFormType == 'StartEvent' || $strFormType == 'EndEvent'){
            if(!empty($strFormType)){
                $arrOutputForm['html'] = $this->renderPartial('_customStartEventForm',
                                                [
                                                    'workflowStartEventModel' => $workflowStartEventModel,
                                                    'keywordsList' => TblKeywords::getAllKeywordLists(),
                                                    'functions_exe_list' => TblFunctions::getAllExecutableFunction(),
                                                    'functions_get_data_list'=>TblFunctions::getAllDataFunction(),
                                                    'element_id'=>$element_id,
                                                    'workflow_id'=>$workflow_id,
                                                ]
                                            );
            }

            return json_encode($arrOutputForm);
        }
    }


    /**
     * Updates an existing Workflow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'workflowLayout';
        $model = $this->findModel($id);
        $post_data=Yii::$app->request->post();
        if(!empty(Yii::$app->request->post()['workflow_json'])){
            $post_data['Workflow']['workflow_json']=Yii::$app->request->post()['workflow_json'];
        }
        if(!empty(Yii::$app->request->post()['workflow_data'])){
            $post_data['Workflow']['workflow_data']=Yii::$app->request->post()['workflow_data'];
        }
        //$post_data=Yii::$app->request->post();
        
        if ($model->load($post_data) && $model->save()) {
            /* -------------------- For Updating Records in MongoDB ------------------------------*/
            $session_id=Yii::$app->session->Id;
            try{
                $logged_in_user_id=Yii::$app->user->identity->id;
            }
            catch (\Exception $ex){
                $logged_in_user_id='';
            }
            $updateStatus=MongoWorkFlow::updateAll(['saved_in_db'=>'1','updated_by'=>$logged_in_user_id,'updated_at'=>time(),'id_in_db'=>$model->id],['session_id'=>$session_id]);
            /* ------------------------ End ------------------------------------------------------*/
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'workflow_id'=>$id
        ]);
    }
    
    /**
     * Deletes an existing Workflow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Workflow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workflow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workflow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    // For Saving Data in MongoDB
    public function actionMongoCreate()
    {
        $model = new MongoWorkFlow();
        $session_id=Yii::$app->session->Id;
        try{
            $logged_in_user_id=Yii::$app->user->identity->id;
        }
        catch (\Exception $ex){
            $logged_in_user_id='';
        }
        if (Yii::$app->request->isAjax) {
            // Workflow Validation
            $json_array=array();
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post_data=Yii::$app->request->post();
            $json_array[$post_data['element_id']]=$post_data['WorkflowStartEventModel'];
            $workflowStartEventModel = new WorkflowStartEventModel();
            $workflowStartEventModel->load($post_data);
            ActiveForm::validate($workflowStartEventModel);
            $errors=$workflowStartEventModel->errors;
            $workflow_id=$post_data['workflow_id'];
            $json_data=json_encode($json_array);
            if(!$errors){
                $updateModel = MongoWorkFlow::findOne(['workflow_id' => $workflow_id]);
                $data_arr['MongoWorkflow']=array('workflow_id'=>$workflow_id,'workflow_data'=>$json_data,'workflow_json'=>$post_data['form_json_data'],'created_by'=>$logged_in_user_id,'created_at'=>time(),'updated_by'=>$logged_in_user_id,'updated_at'=>time(),'saved_in_db'=>'0');
                if(!$updateModel){
                    if ($model->load($data_arr) && $model->save()) {
                        return ['status'=>'success','json_data'=>$json_data,'id'=>$workflow_id];
                    }
                }
                else{
                    // Get Data And Insert New Array and Update
                    $old_data=$updateModel['workflow_data'];
                    $old_data=json_decode($old_data,true);
                    $old_data[$post_data['element_id']]=$post_data['WorkflowStartEventModel'];
                    //array_push($old_data, $json_array);
                    $json_data=json_encode($old_data);
                    $updateStatus=MongoWorkFlow::updateAll(['workflow_data'=>$json_data,'updated_by'=>$logged_in_user_id,'updated_at'=>time(),'workflow_json'=>$post_data['form_json_data'],'saved_in_db'=>'0'],['workflow_id'=>$workflow_id]);
                    return ['status'=>'success','json_data'=>$json_data,'id'=>$workflow_id];
                }
            }else{
                return $errors;
            }
        }
    }
    public function actionClone() {
        $model = new WorkflowClone();
        $wmodel = new Workflow();
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;            
            $model = new WorkflowClone();
            $validation_status=ActiveForm::validate($model,Yii::$app->request->post());
            $data = Yii::$app->request->post();
            $clonedata = array();           
           foreach($data as $k =>$v) {
                foreach($v as $kv => $vv) {                
                    $clonedata[$kv] = $vv['value'];
                }
           }           
           $clone_id = $clonedata[2];
           $clone_type = $clonedata[1];
           if (($clone_db_data = Workflow::findOne($clone_id)) !== null) {                
                $wmodel->workflow_title = $clone_db_data->workflow_title;
                $wmodel->workflow_description = $clone_db_data->workflow_description;
                $wmodel->workflow_data = $clone_db_data->workflow_data;
                if($clone_type== 'data') {
                    $wmodel->workflow_json = $clone_db_data->workflow_json;
                } else {  
                    $work_form_struct_json = array();                  
                    $work_form_array = json_decode($clone_db_data->workflow_json, true);                                          
                    foreach($work_form_array as $wfk => $wfv) {                        
                            $work_form_struct_array[$wfk]['selectedId']     = $wfv['selectedId'];
                            $work_form_struct_array[$wfk]['elementType']    = $wfv['elementType'];
                            $work_form_struct_array[$wfk]['elementSubType'] = $wfv['elementSubType'];
                            $work_form_struct_array[$wfk]['step_no']        = $wfv['step_no'];
                            $work_form_struct_array[$wfk]['keywords']       = $wfv['keywords'];                                                                  
                    }                                                          
                    $work_form_struct_json = json_encode($work_form_struct_array);
                    $wmodel->workflow_json = $work_form_struct_json;
                    
                }               
                $wmodel->save(); 
            }
            return 'success';            
        }     
    }
    /// For Saving Complete Workflow
    /**
     * Creates a new Workflow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSaveWorkflow()
    {
        $post_data='';
        $model = new Workflow();
        try{
            $logged_in_user_id=Yii::$app->user->identity->id;
        }
        catch (\Exception $ex){
            $logged_in_user_id='';
        }
        $workflowDataModel = new WorkflowDataModel();
        $post_data=Yii::$app->request->post();
        if(!empty(Yii::$app->request->post())){
            
            $post_data=Yii::$app->request->post();
            $updateStatus=Workflow::updateAll(['workflow_data'=>$post_data['workflow_data'],'workflow_json'=>$post_data['workflow_json'],'updated_by'=>$logged_in_user_id,'updated_at'=>time()],['id'=>$post_data['w_id']]);
            if($updateStatus){
                return $this->redirect(['index']);
            }
        }
    }
}
