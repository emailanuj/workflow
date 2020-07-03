<?php

namespace app\modules\bpaService\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\bpaService\models\BandwidthServiceModel;
use app\modules\bpaService\models\Model;
use app\modules\api\components\BandwidthServiceComponent;
use app\modules\api\components\TopologyServiceComponent;

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
                $utlizationPostData = Yii::$app->request->post();                
                foreach($utlizationPostData['BandwidthServiceModel'] as $utilizationPostKey => $utilizationPostValue) {
                    $arrTopologyBestPathLists   = TopologyServiceComponent::getRankwisePath($utilizationPostValue);
                    $arrSegmentLists            = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
                    $utilizationPostValue['segment_ids'] = $arrSegmentLists;
                    $finalUtilizationTable[$utilizationPostValue['a_end_host'].'::'.$utilizationPostValue['z_end_host']] = BandwidthServiceComponent::getBwsUtilizationData($utilizationPostValue);
                }
                //pe($finalUtilizationTable); exit;               
                $reportOutputData['status'] = 'success';
                $reportOutputData['html'] = $this->renderPartial(
                    'bpaReports',
                    [
                        'finalUtilizationTable' => $finalUtilizationTable,

                    ]
                );
                return json_encode($reportOutputData);
            }            
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
