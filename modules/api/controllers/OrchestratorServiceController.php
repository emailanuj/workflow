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
    // private function moduleRequestType()
    // {
    //     return ['SCCM', 'CCSM', 'BPA', 'SRA'];
    // }

    public function actionGetBestPath()
    {
        $arrRequestData = [];
        return $this->manipulatedRequestData($arrRequestData);
    }

    private function manipulatedRequestData($arrRequestData)
    {
        $arrSegmentBestPathLists = $this->getSegmentBestPath($arrRequestData);

        $arrData = [];
        // $arrData = BandwidthServiceComponent::getActualUtilization();
        return $this->apiResponse(200, $arrData, "Bandwidth Service: criteria passed for provisioning");
    }


    private function getSegmentBestPath($arrRequestData)
    {
        $arrTopologyBestPathLists = TopologyServiceComponent::getSegmentLists($arrRequestData);
        $this->getBandwidthService($arrTopologyBestPathLists);
    }

    private function getBandwidthService()
    {
        return BandwidthServiceComponent::getActualUtilization();
    }
}
