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
        return ['SCCM', 'CCSM', 'BPA', 'SRA'];
    }

    public function actionGetBestPath()
    {
        $arrRequestData = [];
        return $this->manipulatedRequestData($arrRequestData);
    }

    private function manipulatedRequestData($arrRequestData)
    {
        $arrSegmentBestPathLists = $this->getSegmentBestPath($arrRequestData);

        // echo '<pre>';
        // print_r($arrSegmentBestPathLists);
        // die;
        // $arrData = [];
        // $arrData = BandwidthServiceComponent::getActualUtilization();
        return $this->apiResponse(200, $arrSegmentBestPathLists, "Bandwidth Service: criteria passed for provisioning");
    }

    private function getSegmentBestPath($arrRequestData)
    {
        $arrTopologyBestPathLists = TopologyServiceComponent::createPayloadData($arrRequestData);
        $arrSegmentLists = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists); 
        $arrBandwidthResponce = BandwidthServiceComponent::getActualUtilization($arrSegmentLists);


        $arrOutputLists = [];
        foreach( $arrTopologyBestPathLists as $strKey => $strData ){
            foreach( $strData as $strIndex => $arrDataLists ){
                $arrOutputLists['segment_id'] = '';
            }

        }
        
        // echo '<pre>';
        // print_r($arrTopologyBestPathLists);
        // print_r($arrBandwidthResponce);
        // die;
        // return $this->getBandwidthService($arrSegmentLists);
    }



    // private function getBandwidthService($arrSegmentIdLists)
    // {
    //     return BandwidthServiceComponent::getActualUtilization($arrSegmentIdLists);
    // }
}
