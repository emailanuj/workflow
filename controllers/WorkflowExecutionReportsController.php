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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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


    
}
