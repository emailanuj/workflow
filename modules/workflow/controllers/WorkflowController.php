<?php

namespace app\modules\workflow\controllers;

use Yii;
use app\modules\workflow\models\Workflow;
use app\modules\workflow\models\WorkflowClone;
use app\modules\workflow\models\WorkflowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\modules\workflow\models\WorkflowDataModel;
use app\modules\workflow\models\TblFunctions;
use app\modules\workflow\models\TblKeywords;
use app\modules\workflow\models\TblCommands;
use app\modules\workflow\models\WorkflowMultipleCommand;
use app\modules\workflow\models\WorkflowCommandMultipleCondition;
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
        if (Yii::$app->request->isAjax && !empty(Yii::$app->request->post())) {
            if ($objWorkflow->load(Yii::$app->request->post()) && $objWorkflow->save()) {
                return $this->redirect(['create', 'id' => $objWorkflow->id]);
            }
            return json_encode($objWorkflow->getErrors());
        }

        echo $this->renderAjax('_customWorkflowSaveForm', [
            'workflowModel' => $objWorkflow,
        ]);
    }

    /**
     * Creates a new Workflow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $this->layout = '//workflowLayout';
        $post_data = '';
        $model = new Workflow();

        if (!empty($id)) {
            $model = $this->findModel($id);
        }
        $title = $model['workflow_title'];
        return $this->render('create', [
            'model' => $model,
            'workflow_id' => $id
        ]);
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
        $post_data = Yii::$app->request->post();
        if (!empty(Yii::$app->request->post()['workflow_json'])) {
            $post_data['Workflow']['workflow_json'] = Yii::$app->request->post()['workflow_json'];
        }
        if (!empty(Yii::$app->request->post()['workflow_data'])) {
            $post_data['Workflow']['workflow_data'] = Yii::$app->request->post()['workflow_data'];
        }
        //$post_data=Yii::$app->request->post();

        if ($model->load($post_data) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'workflow_id' => $id
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



    public function actionCreateWorkflowClone()
    {
        $workflowModel = new WorkflowClone();
        $strFormType = Yii::$app->request->post('form-type');

        if (Yii::$app->request->isAjax && !empty(Yii::$app->request->post()) && $strFormType != 'create-clone') {
            if ($workflowModel->load(Yii::$app->request->post()) && $workflowModel->validate()) {
                $clone_db_data = Workflow::findOne($workflowModel->clone_id);

                $objSaveWorkflowClone = new Workflow();
                $objSaveWorkflowClone->workflow_title = $workflowModel->clone_title;
                $objSaveWorkflowClone->workflow_description = $workflowModel->clone_description;
                $objSaveWorkflowClone->workflow_json = $clone_db_data->workflow_json;

                if ($workflowModel->clone_type == 'data') {
                    $objSaveWorkflowClone->workflow_data = $clone_db_data->workflow_data;
                } else {
                    $arrDataStructure = [];
                    $arrSavedWorkflowData = json_decode($clone_db_data->workflow_data, true);
                    foreach ($arrSavedWorkflowData as $strKey => $arrValues) {
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
        ]);
    }

    /// For Saving Complete Workflow
    /**
     * Creates a new Workflow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSaveWorkflow()
    {
        $post_data = '';
        $model = new Workflow();
        try {
            $logged_in_user_id = Yii::$app->user->identity->id;
        } catch (\Exception $ex) {
            $logged_in_user_id = '';
        }
        $post_data = Yii::$app->request->post();
        //echo '<pre/>'; print_r($post_data); exit;       
        if (!empty(Yii::$app->request->post())) {
            $post_data = Yii::$app->request->post();
            $updateStatus = Workflow::updateAll(['workflow_title' => $post_data['workflow_title'], 'workflow_data' => $post_data['workflow_data'], 'workflow_json' => $post_data['workflow_json'], 'updated_by' => $logged_in_user_id, 'updated_at' => time()], ['id' => $post_data['w_id']]);
            if ($updateStatus) {
                $outputMessage = 'success';
                return json_encode($outputMessage);
            }
        }
    }


    public function actionAjaxWorkflow()
    {
        // $objWorkflow = new Workflow();
        // if(Yii::$app->request->isAjax && !empty(Yii::$app->request->post())  ){
        //     if ( $objWorkflow->load(Yii::$app->request->post()) && $objWorkflow->save() ) {
        //         return $this->redirect(['create', 'id' => $objWorkflow->id]);
        //     }
        //     return json_encode($objWorkflow->getErrors());
        // }

        echo $this->renderAjax('_customWorkflowSaveForm', [
            // '_customSaveWorkFlow' => $objWorkflow,
        ]);
    }

    public function actionGetAjaxForm()
    {
        // pe(Yii::$app->request->post());
        $WorkflowDataModel = new WorkflowDataModel();
        $objWorkflowMultipleCommand = new WorkflowMultipleCommand();
        $objWorkflowCommandMultipleCondition = new WorkflowCommandMultipleCondition();


        if (Yii::$app->request->isAjax && Yii::$app->request->post('form_type')) {
            $strFormType = Yii::$app->request->post('form_type');
            $element_id = Yii::$app->request->post('element_id');
            $workflow_id = Yii::$app->request->post('workflow_id');
            $arrOutputForm = [];
            $arrOutputForm['status'] = 'success';
            if ($strFormType == 'MessageStartEvent') {
                $arrOutputForm['html'] = $this->renderPartial(
                    '_customEmailEventForm',
                    [
                        'WorkflowDataModel' => $WorkflowDataModel,
                        'element_id' => $element_id,
                        'workflow_id' => $workflow_id,
                        'element_type' => $strFormType
                    ]
                );
            } else if ($strFormType == 'datastore') {
                $arrOutputForm['html'] = $this->renderPartial(
                    '_customDataStoreForm',
                    [
                        'WorkflowDataModel' => $WorkflowDataModel,
                        'element_id' => $element_id,
                        'workflow_id' => $workflow_id,
                        'element_type' => $strFormType
                    ]
                );
            } else if ($strFormType == 'flow') {
                $arrOutputForm['html'] = $this->renderPartial(
                    '_customFlowEventForm',
                    [
                        'WorkflowDataModel' => $WorkflowDataModel,
                        'element_id' => $element_id,
                        'workflow_id' => $workflow_id,
                        'element_type' => $strFormType
                    ]
                );
            } else if (!empty($strFormType)) {
                $arrOutputForm['html'] = $this->renderPartial(
                    '_customStartEventForm',
                    [
                        'WorkflowDataModel' => $WorkflowDataModel,
                        'keywordsList' => TblKeywords::getAllKeywordLists(),
                        'functions_exe_list' => TblFunctions::getAllExecutableFunction(),
                        'functions_get_data_list' => TblFunctions::getAllDataFunction(),
                        'element_id' => $element_id,
                        'workflow_id' => $workflow_id,
                        'element_type' => $strFormType,
                        'objWorkflowMultipleCommand' => $objWorkflowMultipleCommand,
                        'objWorkflowCommandMultipleCondition' => $objWorkflowCommandMultipleCondition,
                    ]
                );
            }
            return json_encode($arrOutputForm);
        }

        if (Yii::$app->request->isAjax && Yii::$app->request->post('WorkflowDataModel')) {
            $ajaxFormJson = array();
            $userId = Yii::$app->user->identity->id;
            Yii::$app->response->format = Response::FORMAT_JSON;
            $ajaxFormPostData = Yii::$app->request->post();
            // pe($ajaxFormPostData);
            $ajaxFormJson[$ajaxFormPostData['element_id']] = $ajaxFormPostData['WorkflowDataModel'];
            // Adding Scenario Based on Keywords
            $elementType = $ajaxFormPostData['element_type'];
            if ($elementType == 'MessageStartEvent' || $elementType == 'datastore' || $elementType == 'flow') {
                $WorkflowDataModel->scenario = $elementType;
            } else {
                $keywords = $ajaxFormJson[$ajaxFormPostData['element_id']]['keywords'];
                if (!empty($keywords)) {
                    $WorkflowDataModel->scenario = $keywords;
                }
            }

            if ($WorkflowDataModel->load($ajaxFormPostData) && $WorkflowDataModel->validate()) {


                $workflowId = $ajaxFormPostData['workflow_id'];
                //$workflowUniqueId = uniqid($workflowId,$userId);
                if (!empty($ajaxFormPostData['saved_form_data'])) {
                    $savedFormDataJson = json_decode($ajaxFormPostData['saved_form_data'], true);
                    $finalFormJson = array_merge($savedFormDataJson, $ajaxFormJson);
                    //$uniqueFormJson[$workflowUniqueId] = $finalFormJson;
                    $ajaxFormJsonData = json_encode($finalFormJson);
                } else {
                    //$uniqueFormJson[$workflowUniqueId] = $ajaxFormJson;
                    $ajaxFormJsonData = json_encode($ajaxFormJson);
                }
                return ['status' => 'success', 'json_data' => $ajaxFormJsonData, 'id' => $workflowId];
            } else {
                // $errors = $WorkflowDataModel->errors;
                // pe($WorkflowDataModel->getErrors());
                $errors = $WorkflowDataModel->getErrors();
                return ['status' => 'error', 'error' => $errors];
            }
            // if (!$errors) {

            // } else {

            // }
        }
    }

    public function actionGetCommandLists()
    {
        $option = "<option value=''>Please select os</option>";
        if (!empty(Yii::$app->request->post())) {
            $strApplicationOs = Yii::$app->request->post('application_os');

            $subModel = new TblCommands();
            $listArr = $subModel::find()->select(['id', 'name', 'template_name'])
                ->where(['os_type' => $strApplicationOs])
                ->asArray()
                ->all();
            foreach ($listArr as $key => $value) {
                $option .= "<option value='{$value['name']}' command_id='{$value['id']}' template_name='{$value['template_name']}'>" . $value['name'] . "</option>";
            }
        }
        echo $option;
        die;
    }

    public function actionParseCommand()
    {
        $jsonData = ["MODE", "ALIAS", "COMMAND", "COUNT_OF_RECORD", "COMMAND_OUTPUT", "PARSE_OUTPUT"];
        echo json_encode($jsonData);
        die;
    }
}
