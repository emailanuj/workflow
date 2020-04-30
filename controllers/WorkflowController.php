<?php

namespace app\controllers;

use Yii;
use app\models\Workflow;
use app\models\MongoWorkFlow;
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
            $post_data['Workflow']['workflow_json']=$post_data['workflow_json'];
            $post_data['Workflow']['workflow_data']=$post_data['workflow_data'];
        
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
                $updateStatus=MongoWorkFlow::updateAll(['saved_in_db'=>'1','updated_by'=>$logged_in_user_id,'updated_at'=>time(),'id_in_db'=>$model->id],['session_id'=>$session_id]);
                /* ------------------------ End ------------------------------------------------------*/
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'workflowDataModel' => $workflowDataModel,
            'template_id'=>$id
        ]);
    }



    public function actionGetAjaxForm()
    {
        $workflowStartEventModel = new WorkflowStartEventModel();
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost ){
            
            $strFormType=Yii::$app->request->post('form_type');

            $arrOutputForm = [];
            $arrOutputForm['status'] = 'success';
            //if( $strFormType == 'StartEvent' || $strFormType == 'EndEvent'){
            if(!empty($strFormType)){
                $arrOutputForm['html'] = $this->renderPartial('_customStartEventForm',
                                                [
                                                    'workflowStartEventModel' => $workflowStartEventModel,
                                                    'keywordsList' => TblKeywords::getAllKeywordLists(),
                                                    'functions_exe_list' => TblFunctions::getAllExecutableFunction(),
                                                    'functions_get_data_list'=>TblFunctions::getAllDataFunction()
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
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            // Workflow Validation
            $workflowStartEventModel = new WorkflowStartEventModel();
            $validation_status=ActiveForm::validate($workflowStartEventModel,Yii::$app->request->post());
            
            $data = Yii::$app->request->post();
        }
        $updateModel = MongoWorkFlow::findOne(['session_id' => $session_id]);
        $data_arr['MongoWorkflow']=array('session_id'=>$session_id,'workflow_data'=>$data['workflow_data'],'workflow_json'=>$data['workflow_json'],'created_by'=>$logged_in_user_id,'created_at'=>time(),'updated_by'=>$logged_in_user_id,'updated_at'=>time(),'saved_in_db'=>'0','id_in_db'=>'0');
        if(!$updateModel){
            if ($model->load($data_arr) && $model->save()) {
                return ['status'=>'success'];
            }
        }
        else{
            $updateStatus=MongoWorkFlow::updateAll(['workflow_data'=>$data['workflow_data'],'updated_by'=>$logged_in_user_id,'updated_at'=>time(),'workflow_json'=>$data['workflow_json'],'saved_in_db'=>'0','id_in_db'=>'0'],['session_id'=>$session_id]);
        }
        return ['status'=>'success'];
    }
}
