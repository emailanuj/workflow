<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\components\BaseController;
use app\modules\api\components\TopologyServiceComponent;
use app\modules\api\components\BandwidthServiceComponent;
use app\modules\threshold\models\ThresholdSettings;
use yii\helpers\json;
use yii\base\InvalidArgumentException;

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
        //Yii::$app->request->post() |  Yii::$app->request->queryParams; || Yii::$app->request->getRawBody()
        $jsonRequestData = Yii::$app->request->getRawBody();
        return $this->manipulatedRequestData($jsonRequestData);
    }

    private function manipulatedRequestData($jsonRequestData)
    {
        //$moduleRequestType = 'BPA';
        // $bpaRequest = '{"status":"Success","code":"2001","OrderNumber":223006,"OrderId":"6df67f79-0640-59c2-83c7-208149e7aff5","data":[{"CircuitID":"MWRTN-P2P-62208-ABIS-P-C","status":"Success","message":"Bandwidth Service: criteria passed for provisioning","bws_output":[{"configured_capacity":100000.0,"peak_time":"2020-03-31 21:00:49","peak_value":0.743,"segment_id":22042,"segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":1,"utilization_actual":0.743},{"configured_capacity":100000.0,"peak_time":"2020-03-31 21:00:49","peak_value":0.743,"segment_id":22043,"segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUMSC-ISP-NGW-RTR-055__et-11/1/0.10","tag":1,"utilization_actual":0.743}]},{"CircuitID ":"MWRTN - P2P - 62205 - ABIS - P - C ","status":"","Success":"","message ":"","Bandwidth Service":"criteria passed","for provisioning ":"","bws_output ":[{"configured_capacity ":100000.0,"peak_time ":"2020 - 03 - 31 21: 00: 49 ","peak_value ":0.743,"segment_id ":22010,"segment_mapping ":"AHD - CGR - ISP - ACC - RTR - 221 __et - 0 / 1 / 1.10 __MUM - SC - ISPNGW - RTR - 055 __et - 11 / 1 / 0.10 ","tag ":1,"utilization_actual ":0.743},{"configured_capacity ":100000.0,"peak_time ":"2020 - 03 - 31 21: 00: 49 ","peak_value ":0.743,"segment_id ":22011,"segment_mapping ":"AHD - CGR - ISP - ACC - RTR - 221 __et - 0 / 1 / 1.10 __MUMSC - ISP - NGW - RTR - 055 __et - 11 / 1 / 0.10 ","tag ":1,"utilization_actual ":0.743}]}]}';

        // $moduleRequestType = 'SRA';
        // $arrRequestData = '{"segment_ids":"[20525,20524,20526]","bandwidth_provision":"9000"}';
        //$arrRequestData = '{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","destination_hostname":"MUM-SC-ISPNGW-RTR-055"}';

        //$moduleRequestType = 'CCSM';
        $jsonRequestData   =  '{"module_type": "CCSM","source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10"}';
        $arrRequestData = json_decode($jsonRequestData, true);

        switch ($arrRequestData['module_type']) {
            case "BPA":
                $arrSegmentBestPathLists = $this->getBpaBestPath($jsonRequestData);
                break;

            case "SRA":
                $arrSegmentBestPathLists = $this->getSraBestPath($jsonRequestData);
                break;

            case "CCSM":
                $arrSegmentBestPathLists = $this->getCcsmBestPath($jsonRequestData);
                break;

            default:
                $arrSegmentBestPathLists = $this->apiResponse(402, "Incompleate information, for which module you need data.");
                break;
        }
        return $arrSegmentBestPathLists;
        // if (!empty($arrSegmentBestPathLists)) {
        //     return $this->apiResponse(200, $arrSegmentBestPathLists, "Bandwidth Service: criteria passed for provisioning");
        // } else {
        //     return $this->apiResponse(402, "Incompleate information, for which module you need data.");
        // }
    }

    private function getCcsmBestPath($arrRequestData)
    {
        //validate Request        
        try {
            $requestArrData = json::decode($arrRequestData, true);
            // get flap link's bandwidth
            // $segmentId  = TopologyServiceComponent::getSegmentId($arrRequestData);
            // $peakBandwidth = BandWidthServiceComponent::getPeakUtilization($segmentId);
            // $strAffixUtilization = $peakBandwidth['peak_bw'];
            $strAffixUtilization = '9000';
            $arrTopologyBestPathLists   = $this->getModuleBestPath($arrRequestData);
            $arrPathsBandwidths         = $this->getModulePathBandwidth($arrTopologyBestPathLists, $arrSegments = []);
            $arrOutputLists             = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $strAffixUtilization);
        } catch (InvalidArgumentException $jsonError) {
            return $jsonError->getMessage();
        }
        
        // change response
        //pe($arrOutputLists);
        return $arrOutputLists;
    }

    private function getSraBestPath($arrRequestData)
    {
        //validate Request        
        try {
            $requestArrData = json::decode($arrRequestData, true);
            if (!empty($requestArrData['bandwidth_provision']) && !empty($requestArrData['segment_ids'])) {
                $strAffixUtilization = $requestArrData['bandwidth_provision'];
                $arrSegments         = $requestArrData['segment_ids'];
                $arrSegments         = json::decode($arrSegments);
                $arrPathsBandwidths  = $this->getModulePathBandwidth($topologyarr = [], $arrSegments);
                $arrOutputLists      = $this->setModulePathBandwidth($arrPathsBandwidths, $strAffixUtilization);
            } else if (!empty($requestArrData['source_hostname']) && !empty($requestArrData['destination_hostname'])) {
                // get flap link's bandwidth
                // $segmentId  = TopologyServiceComponent::getSegmentId($arrRequestData);
                // $peakBandwidth = BandWidthServiceComponent::getPeakUtilization($segmentId);
                // $strAffixUtilization = $peakBandwidth['peak_bw'];
                $strAffixUtilization = '9000';
                $arrTopologyBestPathLists = $this->getModuleBestPath($arrRequestData);
                $arrPathsBandwidths       = $this->getModulePathBandwidth($arrTopologyBestPathLists, $arrSegments = []);
                $arrOutputLists           = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $strAffixUtilization);
            }
        } catch (InvalidArgumentException $jsonError) {
            return $jsonError->getMessage();
        }

        // change response
        return $arrOutputLists;
    }

    private function getBpaBestPath($arrRequestData)
    {
        //validate Request        
        try {
            $requestArrData = json::decode($arrRequestData, true);
            $strAffixUtilization = $requestArrData['bandwidth_provision'];
            $arrTopologyBestPathLists = $this->getModuleBestPath($arrRequestData);
            $arrPathsBandwidths       = $this->getModulePathBandwidth($arrTopologyBestPathLists, $arrSegments = []);
            $arrOutputLists           = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $strAffixUtilization);
        } catch (InvalidArgumentException $jsonError) {
            return $jsonError->getMessage();
        }
        
        // change response
        return $arrOutputLists;
    }


    private function getModuleBestPath($arrRequestData)
    {
        $arrTopologyBestPathLists   = TopologyServiceComponent::getRankwisePath($arrRequestData);
        return $arrTopologyBestPathLists;
    }

    private function getModulePathBandwidth($arrTopologyBestPathLists, $arrSegmentLists)
    {
        if (empty($arrSegmentLists) && !empty($arrTopologyBestPathLists)) {
            $arrSegmentLists    = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
        }            
        $arrBandwidthResponse   = BandwidthServiceComponent::getAllUtilization($arrSegmentLists);        
        return $arrBandwidthResponse;
    }



    private function calculateBestPath($arrTopologyBestPathLists, $arrBandwidthResponse, $strAffixUtilization)
    {

        $arrOutputLists = [];
        $arrBwsOutputLists = [];
        $strBwsStatusCheck = 0;
        $strBwsIndexCounter = 0;
        foreach ($arrTopologyBestPathLists as $strHostKey => $arrPayloadData) {
            $arrPathDetails = [];
            $strSuccessCounter = 0;
            foreach ($arrPayloadData as $strPayloadKey => $strPayloadValue) {
                if (array_key_exists($strPayloadValue['seg_id'], $arrBandwidthResponse)) {
                    
                    $intActualUtilization = isset($arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_bw']) ? $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_bw'] : 0;
                    $intTotalUtilization = isset($arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_capacity']) ? $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_capacity'] : 0;

                    $strModuleName = 'CCSM';
                    $intCurrentPercentage = Yii::$app->formatter->asPercent((($intActualUtilization + $strAffixUtilization) / $intTotalUtilization));
                    $intCurrentPercentage = str_replace('%', '', $intCurrentPercentage);
                    $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($strModuleName, $intCurrentPercentage);

                    $strCurrentStatus = 'rejected';
                    if ($bolGetThresholdCheckData['status'] == 'success') {
                        $strCurrentStatus = 'selected';
                        $strSuccessCounter++;
                    }
                    $arrPathDetails[$strPayloadKey]['status']       =  $strCurrentStatus;
                    $arrPathDetails[$strPayloadKey]['reason']       =  $bolGetThresholdCheckData['message'];
                    $arrPathDetails[$strPayloadKey]['segment_id']   =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['actual_time']  =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_time'];
                    $arrPathDetails[$strPayloadKey]['actual_bw']    =  $intActualUtilization;
                    $arrPathDetails[$strPayloadKey]['actual_capacity']  =  $intTotalUtilization;
                    $arrPathDetails[$strPayloadKey]['peak_time']        =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['peak_time'];
                    $arrPathDetails[$strPayloadKey]['peak_bw']          =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['peak_bw'];
                    $arrPathDetails[$strPayloadKey]['peak_capacity']    =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['peak_capacity'];
                    $arrPathDetails[$strPayloadKey]['avg_bw']           =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['avg_bw'];
                    $arrPathDetails[$strPayloadKey]['percentile95_bw']  =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['percentile95_bw'];
                    $arrPathDetails[$strPayloadKey]['segment_mapping']  =  $strPayloadValue['segement_mapping'];
                    $arrPathDetails[$strPayloadKey]['tag']              =  $strPayloadValue['tag'];
                }
            }

            $strPathStatus  = 'rejected';
            $strPathMsg     = 'Insufficient Bandwidth';
            if ($strSuccessCounter == count($arrPayloadData)) {
                $strPathStatus  = 'selected';
                $strPathMsg     = 'Sufficient Bandwidth';
                $strBwsStatusCheck++;
            }

            $arrBwsOutputLists[$strBwsIndexCounter]['path_status']  = $strPathStatus;
            $arrBwsOutputLists[$strBwsIndexCounter]['message']      = $strPathMsg;
            $arrBwsOutputLists[$strBwsIndexCounter]['path_detail']  = $arrPathDetails;
            $strBwsIndexCounter++;
        }
        $strBwsStatus   = 'Failed';
        $strBwsMsg      = 'Bandwidth Service: criteria failed for provisioning.';
        if ($strBwsStatusCheck > 0) {
            $strBwsStatus = 'Success';
            $strBwsMsg    = 'Bandwidth Service: criteria passed for provisioning.';
        }

        $arrOutputLists['status']           = $strBwsStatus;
        $arrOutputLists['statusMessage']    = $strBwsMsg;
        $arrOutputLists['bws_output']       = $arrBwsOutputLists;
        return $arrOutputLists;
    }

    private function setModulePathBandwidth($arrBandwidthResponse, $strAffixUtilization) {
        //pe($arrBandwidthResponse);
        foreach($arrBandwidthResponse as $bandwithKey => $bandwidthValue) {
            $strModuleName = 'SRA';
            $intActualUtilization = isset($bandwidthValue['actual_bw']) ? $bandwidthValue['actual_bw'] : 0;
            $intTotalUtilization = isset($bandwidthValue['actual_capacity']) ? $bandwidthValue['actual_capacity'] : 0;

            $intCurrentPercentage = Yii::$app->formatter->asPercent((($intActualUtilization + $strAffixUtilization) / $intTotalUtilization));
            $intCurrentPercentage = str_replace('%', '', $intCurrentPercentage);
            $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($strModuleName, $intCurrentPercentage);

            $strCurrentStatus = 'rejected';
            if ($bolGetThresholdCheckData['status'] == 'success') {
                $strCurrentStatus = 'selected';
            }
            $arrBandwidthResponse[$bandwithKey]['status']       =  $strCurrentStatus;
            $arrBandwidthResponse[$bandwithKey]['reason']       =  $bolGetThresholdCheckData['message'];
            $arrBandwidthResponse[$bandwithKey]['actual_bw']    =  $intActualUtilization;
            $arrBandwidthResponse[$bandwithKey]['actual_capacity']  =  $intTotalUtilization;            
        }
        return  $arrBandwidthResponse; 
    }
}
