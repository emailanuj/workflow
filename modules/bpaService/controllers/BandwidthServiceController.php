<?php

namespace app\modules\bpaService\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\bpaService\models\BandwidthServiceModel;
use app\modules\bpaService\models\Model;

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
        //echo 'hi'; exit;
        $modelsBandwidth = [new BandwidthServiceModel];
        
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $modelsBandwidth = Model::createMultiple(BandwidthServiceModel::classname());
            Model::loadMultiple($modelsBandwidth, Yii::$app->request->post());
            $valid = Model::validateMultiple($modelsBandwidth);
            $reportOutputData = [];
            if ($valid) {
               // echo '<pre>'; print_r(Yii::$app->request->post());die;
                $reportOutputData['status'] = 'success';
                $json = '[{"id":"1","segment_mapping":"A/B","provisional_bandwidth":"200MB","actual_bandwidth":"120MB","commision_bandwidth":"100MB"},{"id":"2","segment_mapping":"B/C","provisional_bandwidth":"290MB","actual_bandwidth":"220MB","commision_bandwidth":"100MB"},{"id":"3","segment_mapping":"C/D","provisional_bandwidth":"300MB","actual_bandwidth":"320MB","commision_bandwidth":"100MB"},{"id":"4","segment_mapping":"D/E","provisional_bandwidth":"340MB","actual_bandwidth":"420MB","commision_bandwidth":"100MB"}]';
                $reportOutputData['html'] = $this->renderPartial(
                    'bpaReports',
                    [
                        'bpaReports' => $json,

                    ]
                );
                return json_encode($reportOutputData);
            }
            //echo 'bi'; exit;
            $reportOutputData['status'] = 'failed';
            $reportOutputData['html'] = '';
            return json_encode($reportOutputData);
        }
        $durationFilter = array("0" => "0");
        return $this->render('index', [
            'modelsBandwidth' => $modelsBandwidth,            
            'utilization' => BandwidthServiceModel::getUtilization(),
            'duration' =>   BandwidthServiceModel::getDuration(), 
            'duration_filter' => $durationFilter,           
            'utilizationType' => BandwidthServiceModel::getUtilizationType()
        ]);
    }
}
