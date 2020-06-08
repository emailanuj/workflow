<?php

namespace app\modules\workflow\controllers;

use Yii;
use app\modules\workflow\models\Workflow;
use app\modules\workflow\models\MongoWorkFlow;
use app\modules\workflow\models\WorkflowClone;
use app\modules\workflow\models\WorkflowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\modules\workflow\models\WorkflowDataModel;
use app\modules\workflow\models\WorkflowStartEventModel;
use app\modules\workflow\models\TblFunctions;
use app\modules\workflow\models\TblKeywords;
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
        $searchModel = new WorkflowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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


    public function actionCreateWorkflow()
    {        
        $objWorkflow = new Workflow();
        if(Yii::$app->request->isAjax && !empty(Yii::$app->request->post())  ){
            if ( $objWorkflow->load(Yii::$app->request->post()) && $objWorkflow->save() ) {
                return $this->redirect(['create', 'id' => $objWorkflow->id]);
            }
            return json_encode($objWorkflow->getErrors());
        }

        echo $this->renderAjax('_customWorkflowSaveForm', [
                                                'workflowModel' => $objWorkflow,
                                            ]
        );
    }

    /**
     * Creates a new Workflow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {        
        $this->layout = '//workflowLayout';
        $post_data='';
        $model = new Workflow();
        
        $workflowDataModel = new WorkflowDataModel();
        // if(!empty(Yii::$app->request->post())){
        //     $post_data=Yii::$app->request->post();        
        //     if ($model->load($post_data) && $model->save()) {
        //         $post_data=Yii::$app->request->post();
        //         /* -------------------- For Updating Records in MongoDB ------------------------------*/
        //         $session_id=Yii::$app->session->Id;
        //         try{
        //             $logged_in_user_id=Yii::$app->user->identity->id;
        //         }
        //         catch (\Exception $ex){
        //             $logged_in_user_id='';
        //         }
        //         /* ------------------------ End ------------------------------------------------------*/
        //         return $this->redirect(['create', 'id' => $model->id]);
        //     }
        // }
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
            if( $strFormType == 'parallel' || $strFormType == 'inclusive' || $strFormType == 'exclusive' || $strFormType=='event'){
                $arrOutputForm['html'] = $this->renderPartial('_customConditionEventForm',
                    [
                        'workflowStartEventModel' => $workflowStartEventModel,
                        'element_id'=>$element_id,
                        'workflow_id'=>$workflow_id,
                        'element_type'=>$strFormType
                    ]
                    );
            } else if( $strFormType == 'MessageStartEvent'){
                $arrOutputForm['html'] = $this->renderPartial('_customEmailEventForm',
                    [
                        'workflowStartEventModel' => $workflowStartEventModel,
                        'element_id'=>$element_id,
                        'workflow_id'=>$workflow_id,
                        'element_type'=>$strFormType
                    ]
                    );
            } else if( $strFormType == 'datastore'){
                $arrOutputForm['html'] = $this->renderPartial('_customDataStoreForm',
                    [
                        'workflowStartEventModel' => $workflowStartEventModel,
                        'element_id'=>$element_id,
                        'workflow_id'=>$workflow_id,
                        'element_type'=>$strFormType
                    ]
                    );
            }
            
            else if(!empty($strFormType)){
                $arrOutputForm['html'] = $this->renderPartial('_customStartEventForm',
                                                [
                                                    'workflowStartEventModel' => $workflowStartEventModel,
                                                    'keywordsList' => TblKeywords::getAllKeywordLists(),
                                                    'functions_exe_list' => TblFunctions::getAllExecutableFunction(),
                                                    'functions_get_data_list'=>TblFunctions::getAllDataFunction(),
                                                    'element_id'=>$element_id,
                                                    'workflow_id'=>$workflow_id,
                                                    'element_type'=>$strFormType
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
        $this->layout = '//workflowLayout';
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
            // Adding Scenario Based on Keywords
            $element_type=$post_data['element_type'];
            if( $element_type == 'parallel' || $element_type == 'inclusive' || $element_type == 'exclusive' || $element_type=='event'){
                $workflowStartEventModel->scenario=$element_type;
            } else if( $element_type == 'MessageStartEvent'){
                $workflowStartEventModel->scenario=$element_type;
            } else if( $element_type == 'datastore'){
                $workflowStartEventModel->scenario=$element_type;
            } else{
                $keywords=$json_array[$post_data['element_id']]['keywords'];
                if(!empty($keywords)){
                    $workflowStartEventModel->scenario=$keywords;
                }
            }
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
                return ['status'=>'error','error'=>$errors];
            }
        }
    }


    public function actionCreateWorkflowClone()
    {
        $workflowModel = new WorkflowClone();
        $strFormType = Yii::$app->request->post('form-type');

        if(Yii::$app->request->isAjax && !empty(Yii::$app->request->post()) && $strFormType != 'create-clone' ){
            if ( $workflowModel->load(Yii::$app->request->post()) && $workflowModel->validate() ) {
                $clone_db_data = Workflow::findOne($workflowModel->clone_id);

                $objSaveWorkflowClone = new Workflow();
                $objSaveWorkflowClone->workflow_title = $workflowModel->clone_title;
                $objSaveWorkflowClone->workflow_description = $workflowModel->clone_description;
                $objSaveWorkflowClone->workflow_json = $clone_db_data->workflow_json;

                if($workflowModel->clone_type == 'data') {
                    $objSaveWorkflowClone->workflow_data = $clone_db_data->workflow_data;
                } else {
                    $arrDataStructure = [];                  
                    $arrSavedWorkflowData = json_decode($clone_db_data->workflow_data, true);          
                    foreach($arrSavedWorkflowData as $strKey => $arrValues) {                        
                        $work_form_struct_array[$strKey]['step_no'] = $arrValues['step_no'];
                        $work_form_struct_array[$strKey]['keywords'] = $arrValues['keywords'];
                    }
                    $objSaveWorkflowClone->workflow_data = json_encode($work_form_struct_array);
                }
                $objSaveWorkflowClone->save();
                return $this->redirect(['update', 'id' => $objSaveWorkflowClone->id]);
            }
            return json_encode($workflowModel->getErrors());
        }

        $workflowModel->clone_id = Yii::$app->request->post('workflow-id');
        echo $this->renderAjax('_customCloneForm', [
                                                'clonemodel' => $workflowModel,
                                            ]
        );
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
            $updateStatus=Workflow::updateAll(['workflow_title'=>$post_data['workflow_title'],'workflow_data'=>$post_data['workflow_data'],'workflow_json'=>$post_data['workflow_json'],'updated_by'=>$logged_in_user_id,'updated_at'=>time()],['id'=>$post_data['w_id']]);
            if($updateStatus){
                return $this->redirect(['index']);
            }
        }
    }

}
