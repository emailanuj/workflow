<?php

namespace app\modules\threshold\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceThresholdController implements the CRUD actions for ServiceThreshold model.
 */
class BpaUseCaseController extends Controller
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
     * Lists all ServiceThreshold models.
     * @return mixed
     */
    public function actionIndex()
    {   
        //$this->layout = '//appassetLayout';     
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost ){ 
            $reportOutputData = [];
            $reportOutputData['status'] = 'success';
            $json = '[{"id":"1","segment_mapping":"A/B","provisioned_bandwidth":"100MB","actual_bandwidth":"120MB"},{"id":"2","segment_mapping":"B/C","provisioned_bandwidth":"200MB","actual_bandwidth":"220MB"},{"id":"3","segment_mapping":"C/D","provisioned_bandwidth":"300MB","actual_bandwidth":"320MB"},{"id":"4","segment_mapping":"D/E","provisioned_bandwidth":"400MB","actual_bandwidth":"420MB"}]';
            $reportOutputData['html'] = $this->renderPartial('bpaReports',
                                            [
                                                'bpaReports'=>$json,                                                
                                                
                                            ]
                                        );
            return json_encode($reportOutputData);
        } else {
            return $this->render('index');
        }

    }

}
