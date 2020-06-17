<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\components\BaseController;
use app\modules\api\components\TopologyServiceComponent;
use app\modules\api\components\BandwidthServiceComponent;

/**
 * OrchestratorService controller for the `api` module
 */
class OrchestratorServiceController extends BaseController
{
    private function moduleRequestType()
    {
        return ['SCCM', 'BPA', 'SRA'];
    }

    public function actionGetBestPath()
    {
        // echo '<pre>'; print_r(Yii::$app->request->post());
        return $this->manipulatedRequestData();
    }

    private function manipulatedRequestData()
    {
        // $arrTopologyServiceData = $this->getTopologyService();
        // $arrBandwidthServiceData = $this->getBandwidthService();
        $arrData = BandwidthServiceComponent::getActualUtilization();
        return $this->apiResponse(200, $arrData, "Customer Created Successfully");
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    private function getTopologyService()
    {
        // $arrData = CurlServiceComponent::getTopologySegmentLists();

    }

    private function getBandwidthService()
    {
    }
}
