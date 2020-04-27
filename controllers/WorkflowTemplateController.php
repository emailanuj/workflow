<?php

namespace app\controllers;

use Yii;
use app\models\WorkflowTemplate;
use app\models\WorkflowTemplateSearch;
use app\models\Workflow;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkflowTemplateController implements the CRUD actions for WorkflowTemplate model.
 */
class WorkflowTemplateController extends Controller
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
     * Lists all WorkflowTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkflowTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkflowTemplate model.
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
     * Creates a new WorkflowTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WorkflowTemplate();
        $wmodel = new Workflow();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $postdata = Yii::$app->request->post();
            $cloneid = $postdata['WorkflowTemplate']['workflow_id'];
            if (($clonedata = Workflow::findOne($cloneid)) !== null) {
                $wmodel->workflow_template_id = $model->id;
                $wmodel->workflow_title = $clonedata->workflow_title;
                $wmodel->workflow_description = $clonedata->workflow_description;
                $wmodel->workflow_data = $clonedata->workflow_data;
                $wmodel->workflow_json = $clonedata->workflow_json; 
                $wmodel->save();                                                
            } 
            $model->workflow_id = $wmodel->id ;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'wmodel' => $wmodel
        ]);
    }

    /**
     * Updates an existing WorkflowTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WorkflowTemplate model.
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
     * Finds the WorkflowTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkflowTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkflowTemplate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
