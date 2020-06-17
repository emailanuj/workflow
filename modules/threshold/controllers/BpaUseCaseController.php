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
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost ){ 
            $reportOutputData = [];
            $reportOutputData['status'] = 'success';
            $json = 'hello';
            $reportOutputData['html'] = $this->renderPartial('bpaReports',
                                            [
                                                'data'=>$json,                                                
                                                
                                            ]
                                        );
            return json_encode($reportOutputData);
        } else {
            return $this->render('index');
        }

    }

}
