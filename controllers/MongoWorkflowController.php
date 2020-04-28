<?php

namespace app\controllers;

use Yii;
use app\models\MongoWorkFlow;
use app\models\MongoWorkflowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use app\models\WorkflowStartEventModel;
/**
 * MongoWorkflowController implements the CRUD actions for MongoWorkFlow model.
 */
class MongoWorkflowController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
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
     * Lists all MongoWorkFlow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MongoWorkflowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MongoWorkFlow model.
     * @param integer $_id
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
     * Creates a new MongoWorkFlow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MongoWorkFlow();
        $post_data=Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

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
    /**
     * Updates an existing MongoWorkFlow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MongoWorkFlow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MongoWorkFlow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return MongoWorkFlow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MongoWorkFlow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
