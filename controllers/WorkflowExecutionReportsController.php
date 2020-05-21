<?php

namespace app\controllers;

use Yii;
use app\models\Workflow;
use app\models\WorkflowExecution;
use app\models\WorkflowExecutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * WorkflowExecutionReportsController implements the CRUD actions for WorkflowExecution model.
*/
class WorkflowExecutionReportsController extends Controller
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
        $searchModel = new WorkflowExecutionSearch();
        $dataProvider = $searchModel->searchWorkflowReport(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetWorkflowExecutedDetails() {

        $this->layout = 'workflowLayout';
        $id = Yii::$app->request->get('id');
        $execution_id = Yii::$app->request->get('execution_id');

        if (($model = Workflow::findOne($id)) !== null) {

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

            return $this->render('workflow-executed-details', [                    
                'model'    => $model,
                'workflow_id' => $id,
                'dataProvider' => $provider, 
            ]);                          
        }
    }


    
}
