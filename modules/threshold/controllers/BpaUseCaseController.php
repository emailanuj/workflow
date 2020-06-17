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
        $json = '[{"id":"1","segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/0.10","provisioned_bandwidth":"100MB","actual_bandwidth":"50MB"},{"id":"2","segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-1/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/1.10","provisioned_bandwidth":"150MB","actual_bandwidth":"100MB"},{"id":"3","segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-1/4/1.10__MUM-SC-ISPNGW-RTR-055__et-11/4/1.10","provisioned_bandwidth":"200MB","actual_bandwidth":"150MB"},{"id":"4","segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-1/5/1.10__MUM-SC-ISPNGW-RTR-055__et-11/5/1.10","provisioned_bandwidth":"250MB","actual_bandwidth":"250MB"},{"id":"5","segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-1/5/2.10__MUM-SC-ISPNGW-RTR-055__et-11/5/2.10","provisioned_bandwidth":"350MB","actual_bandwidth":"280MB"}]';
        

        return $this->render('index', [
            'data' => $json
        ]);
    }

}
