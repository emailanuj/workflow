<?php

namespace app\modules\bpaService\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\bpaService\models\BandwidthCircuitServiceModel;

/**
 * BandwidthServiceController implements the CRUD actions for BandwidthService model.
 */
class BandwidthCircuitServiceController extends Controller
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
        $objBandwidthServiceModel = new BandwidthCircuitServiceModel();
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $reportOutputData = [];            
            $postdata = Yii::$app->request->post();
            $host_count = count($postdata['BandwidthCircuitServiceModel']['z_end_host']);            
            if ( $objBandwidthServiceModel->load(Yii::$app->request->post())) {
                $validcount = 0;
                for($hc=0;$hc<$host_count;$hc++) {
                    $objBandwidthServiceMultiModel = new BandwidthCircuitServiceModel();
                    $objBandwidthServiceMultiModel->a_end_host = $postdata['BandwidthCircuitServiceModel']['a_end_host'][$hc];
                    $objBandwidthServiceMultiModel->a_end_ip = $postdata['BandwidthCircuitServiceModel']['a_end_ip'][$hc];
                    $objBandwidthServiceMultiModel->z_end_host = $postdata['BandwidthCircuitServiceModel']['z_end_host'][$hc];
                    $objBandwidthServiceMultiModel->z_end_ip = $postdata['BandwidthCircuitServiceModel']['z_end_ip'][$hc];
                    $valid=$objBandwidthServiceMultiModel->validate();
                    if($valid) { $validcount++; }
                }
                if($validcount == $host_count) {
                    $reportOutputData['status'] = 'success';
                    $json = '[{"id":"1","segment_mapping":"A/B","provisioned_bandwidth":"100MB","actual_bandwidth":"120MB"},{"id":"2","segment_mapping":"B/C","provisioned_bandwidth":"200MB","actual_bandwidth":"220MB"},{"id":"3","segment_mapping":"C/D","provisioned_bandwidth":"300MB","actual_bandwidth":"320MB"},{"id":"4","segment_mapping":"D/E","provisioned_bandwidth":"400MB","actual_bandwidth":"420MB"}]';
                    $reportOutputData['html'] = $this->renderPartial(
                        'bpaReports',
                        [
                            'bpaReports' => $json,

                        ]
                    );
                    return json_encode($reportOutputData);
                } else {
                    $reportOutputData['status'] = 'failed';
                    $reportOutputData['html'] = $objBandwidthServiceMultiModel->getErrors();
                    return json_encode($reportOutputData);
                }
            }
            $reportOutputData['status'] = 'failed';
            $reportOutputData['html'] = $objBandwidthServiceModel->getErrors();
            return json_encode($reportOutputData);
        }

        return $this->render('index', [
            'bandwidthCircuitServiceModel' => $objBandwidthServiceModel,
            'utilization' => BandwidthCircuitServiceModel::getUtilization(),
            'duration' => BandwidthCircuitServiceModel::getDuration(),
            'utilizationType' => BandwidthCircuitServiceModel::getUtilizationType()
        ]);
    }
}
