<?php

namespace app\modules\workflow\controllers;

use Yii;
use app\modules\workflow\models\Workflow;
use app\modules\workflow\models\WorkflowExecution;
use app\modules\workflow\models\WorkflowExecutionSearch;
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

        $this->layout = '//workflowLayout';
        $id = Yii::$app->request->get('id');
        $execution_id = Yii::$app->request->get('execution_id');

        if (($model = Workflow::findOne($id)) !== null) {

            $query = (new Query())->from(WorkflowExecution::tableName())->where(['instance_id' => $model->id, 'execution_id' => $execution_id]);
            $provider = new ActiveDataProvider([
                'query' => $query,                
                'sort' => [
                    'defaultOrder' => [
                        //'created_at' => SORT_DESC,
                        //'request_params' => SORT_ASC,
                    ]
                ],
            ]);

            $arrWorkflowDiagram = WorkflowExecution::find()->select('workflow_diagram')->where(['instance_id' => $model->id, 'execution_id' => $execution_id])->orderBy(['id' => SORT_DESC])->AsArray()->one();

            return $this->render('workflow-executed-details', [                    
                'model'    => $model,
                'workflow_id' => $id,
                'dataProvider' => $provider, 
                'workflow_dragram' => $arrWorkflowDiagram
            ]);
        }
    }
}
