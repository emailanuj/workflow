<?php

namespace app\modules\bpaService\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\bpaService\models\BandwidthCircuitServiceModel;
use app\modules\api\components\BandwidthServiceComponent;
use app\modules\api\components\TopologyServiceComponent;
use app\modules\api\components\OrchestratorComponent;


/**
 * BandwidthServiceController implements the CRUD actions for BandwidthService model.
 */
class BandwidthCircuitServiceController extends Controller
{
    private $strUniqueId = '';
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
        $this->strUniqueId = uniqid();
        $objBandwidthServiceModel = new BandwidthCircuitServiceModel();
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $reportOutputData = [];            
            $bpaCircuitPostData = Yii::$app->request->post();                    
            
            if ($objBandwidthServiceModel->load(Yii::$app->request->post()) && $objBandwidthServiceModel->validate()) {                               
                    
                $arrTopologyBestPathLists = TopologyServiceComponent::getRankwisePath(json_encode($bpaCircuitPostData),$this->strUniqueId);                
                $arrSegmentLists          = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);                
                $arrPathsBandwidths       = BandwidthServiceComponent::getAllUtilization($arrSegmentLists, $this->strUniqueId);
                $arrOutputResult          = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, 'BPA', '9000','MPLS-L3','ckt-123');
                //pe($arrOutputResult);
                
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
            else {
                return json_encode($objBandwidthServiceModel->getErrors());
            }
        }

        return $this->render('index', [
            'bandwidthCircuitServiceModel' => $objBandwidthServiceModel
        ]);
    }
}
