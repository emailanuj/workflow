<?php

namespace app\modules\bpaService\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\bpaService\models\BandwidthServiceModel;
use app\modules\threshold\models\MyThresholdSettings;
use app\modules\threshold\models\ThresholdSettings;

/**
 * BandwidthServiceController implements the CRUD actions for BandwidthService model.
 */
class BandwidthServiceController extends Controller
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
     * Lists all BandwidthService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $objBandwidthServiceModel = new BandwidthServiceModel();
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $reportOutputData = [];
            if ( $objBandwidthServiceModel->load(Yii::$app->request->post()) && $objBandwidthServiceModel->validate() ) {
                // echo '<pre>'; print_r(Yii::$app->request->post());die;
                $reportOutputData['status'] = 'success';
                $json = '[{"id":"1","segment_mapping":"A/B","provisioned_bandwidth":"100MB","actual_bandwidth":"120MB"},{"id":"2","segment_mapping":"B/C","provisioned_bandwidth":"200MB","actual_bandwidth":"220MB"},{"id":"3","segment_mapping":"C/D","provisioned_bandwidth":"300MB","actual_bandwidth":"320MB"},{"id":"4","segment_mapping":"D/E","provisioned_bandwidth":"400MB","actual_bandwidth":"420MB"}]';
                $reportOutputData['html'] = $this->renderPartial(
                    'bpaReports',
                    [
                        'bpaReports' => $json,

                    ]
                );
                return json_encode($reportOutputData);
            }
            $reportOutputData['status'] = 'failed';
            $reportOutputData['html'] = $objBandwidthServiceModel->getErrors();
            return json_encode($reportOutputData);
        }

        return $this->render('index', [
            'bandwidthServiceModel' => $objBandwidthServiceModel,
            'networks' => ThresholdSettings::networkList(),
            'services' => ThresholdSettings::serviceList(),
            'tags' => ThresholdSettings::tags(),
            'utilization' => BandwidthServiceModel::getUtilization(),
            'duration' => BandwidthServiceModel::getDuration(),
            'hour_duration'    => BandwidthServiceModel::getHours(),
            'day_duration'    => BandwidthServiceModel::getDays(),
            'utilizationType' => BandwidthServiceModel::getUtilizationType()
        ]);
    }
}
