<?php

namespace app\modules\threshold\controllers;

use Yii;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\modules\threshold\models\MyThresholdSettings;
use app\modules\threshold\models\ThresholdSettings;
use yii\widgets\ActiveForm;


/**
 * ThresholdSettingController implements the CRUD actions for ThresholdSettings model.
 * @author : kulpande@cisco.com
 */
class ThresholdSettingController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all ThresholdSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MyThresholdSettings();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ThresholdSettings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ThresholdSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $kpiList                = MyThresholdSettings::getThresholdDropDown();
        $thresholdNetworks      = ThresholdSettings::networkList();
        $thresholdServices       = ThresholdSettings::serviceList();
        $thresholdTags          = ThresholdSettings::tags();
        $thresholdUtilizations  = ThresholdSettings::utilizationList();
        $thresholdCondition     = ThresholdSettings::thresholdConditions();
        $status                 = ThresholdSettings::thresholdStatus();

        $model = new ThresholdSettings();        
        if(Yii::$app->request->post()) {             
            if (yii::$app->request->post('ThresholdSettings')['threshold_name'] == 'BPA') {
                $model->scenario = 'BPA';
            } 
            if($model->load(yii::$app->request->post())) {
                ActiveForm::validate($model);
                $errors = $model->errors;
                if(!$errors) {
                    $model->save();
                    return $this->redirect('index');
                } else {
                    return $this->render('create', [
                        'error' => $errors,'model' => $model, 'kpiList' => $kpiList, 'thresholdNetworks' => $thresholdNetworks,'thresholdServices' => $thresholdServices,'thresholdTags' => $thresholdTags,'thresholdUtilizations' => $thresholdUtilizations, 'thresholdCondition' => $thresholdCondition, 'status' => $status
                    ]);
                }
            }               
                        
        } else {
            return $this->render('create', [
                'model' => $model, 'kpiList' => $kpiList, 'thresholdNetworks' => $thresholdNetworks,'thresholdServices' => $thresholdServices,'thresholdTags' => $thresholdTags,'thresholdUtilizations' => $thresholdUtilizations, 'thresholdCondition' => $thresholdCondition, 'status' => $status
            ]);
        }
    }

    /**
     * Updates an existing ThresholdSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $thresholdCondition = ThresholdSettings::thresholdConditions();
        $status = ThresholdSettings::thresholdStatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model, 'thresholdCondition' => $thresholdCondition, 'status' => $status
            ]);
        }
    }

    /**
     * Deletes an existing ThresholdSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ThresholdSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ThresholdSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ThresholdSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
