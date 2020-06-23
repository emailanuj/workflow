<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\components\BaseController;
use app\modules\api\components\TopologyServiceComponent;
use app\modules\api\components\BandwidthServiceComponent;
use app\modules\threshold\models\ThresholdSettings;

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
        // $bpaRequest = '{"status":"Success","code":"2001","OrderNumber":223006,"OrderId":"6df67f79-0640-59c2-83c7-208149e7aff5","data":[{"CircuitID":"MWRTN-P2P-62208-ABIS-P-C","status":"Success","message":"Bandwidth Service: criteria passed for provisioning","bws_output":[{"configured_capacity":100000.0,"peak_time":"2020-03-31 21:00:49","peak_value":0.743,"segment_id":22042,"segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":1,"utilization_actual":0.743},{"configured_capacity":100000.0,"peak_time":"2020-03-31 21:00:49","peak_value":0.743,"segment_id":22043,"segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUMSC-ISP-NGW-RTR-055__et-11/1/0.10","tag":1,"utilization_actual":0.743}]},{"CircuitID ":"MWRTN - P2P - 62205 - ABIS - P - C ","status":"","Success":"","message ":"","Bandwidth Service":"criteria passed","for provisioning ":"","bws_output ":[{"configured_capacity ":100000.0,"peak_time ":"2020 - 03 - 31 21: 00: 49 ","peak_value ":0.743,"segment_id ":22010,"segment_mapping ":"AHD - CGR - ISP - ACC - RTR - 221 __et - 0 / 1 / 1.10 __MUM - SC - ISPNGW - RTR - 055 __et - 11 / 1 / 0.10 ","tag ":1,"utilization_actual ":0.743},{"configured_capacity ":100000.0,"peak_time ":"2020 - 03 - 31 21: 00: 49 ","peak_value ":0.743,"segment_id ":22011,"segment_mapping ":"AHD - CGR - ISP - ACC - RTR - 221 __et - 0 / 1 / 1.10 __MUMSC - ISP - NGW - RTR - 055 __et - 11 / 1 / 0.10 ","tag ":1,"utilization_actual ":0.743}]}]}';
        // $sraRequest = '{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","flap_link":"AHD-MUM","bandwidth_provision":"9000"}';
        // $closeloopRequest = '{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10"}';
        
        $arrRequestData   =  '{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10"}'; 
        $arrSegmentBestPathLists = $this->getModuleBestPath($arrRequestData);   
        if(!empty($arrSegmentBestPathLists)) {
            return $this->apiResponse(200, $arrSegmentBestPathLists, "Bandwidth Service: criteria passed for provisioning");
        } else {
            return $this->apiResponse(402, "Bandwidth Service: criteria passed for provisioning");
        }
    }


    private function getModuleBestPath($arrRequestData)
    {
        $moduleRequestType = 'CCSM';
        $arrTopologyBestPathLists   = TopologyServiceComponent::getRankwisePath($arrRequestData);        
        $arrSegmentLists            = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
        $arrBandwidthResponse       = BandwidthServiceComponent::getAllUtilization($arrSegmentLists);
        //pe($arrBandwidthResponse);
        
        switch ($moduleRequestType) {
            case "BPA":
                $bestPathResponse = $this->getBpaBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse);               
            break;

            case "SRA":
                $bestPathResponse = $this->getSraBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse);                
            break;

            case "CCSM":
                $bestPathResponse = $this->getCcsmBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse);                
            break;

            default:
            $bestPathResponse = '';
            break;
        }
        return $bestPathResponse;
    }

    private function getCcsmBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse) {
        $requestArrData = json_decode($arrRequestData,true);
        // get flap link's bandwidth
        // $segmentId  = TopologyServiceComponent::getSegmentId($arrRequestData);
        // $peakBandwidth = BandWidthServiceComponent::getPeakUtilization($segmentId);
        // $strAffixUtilization = $peakBandwidth['peak_bw'];
        $strAffixUtilization = '9000';
        $arrOutputLists = $this->calculateBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse,$strAffixUtilization);

        // change response

        return $arrOutputLists;
    }

    private function getSraBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse) {
        $requestArrData = json_decode($arrRequestData,true);        
        $strAffixUtilization = $requestArrData['bandwidth_provision'];
        $arrOutputLists = $this->calculateBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse,$strAffixUtilization);

        // change response
        
        return $arrOutputLists;
    }

    private function getBpaBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse) {
        $requestArrData = json_decode($arrRequestData,true);        
        $strAffixUtilization = $requestArrData['bandwidth_provision'];
        $arrOutputLists = $this->calculateBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse,$strAffixUtilization);

        // change response

        return $arrOutputLists;
    }

    private function calculateBestPath($arrRequestData,$arrTopologyBestPathLists,$arrSegmentLists,$arrBandwidthResponse,$strAffixUtilization) {
        $arrOutputLists = []; $arrBwsOutputLists = []; $strBwsStatusCheck = 0; $strBwsIndexCounter = 0;
        foreach ($arrTopologyBestPathLists as $strHostKey => $arrPayloadData) {
            $arrPathDetails = [];
            $strSuccessCounter = 0;
            foreach ($arrPayloadData as $strPayloadKey => $strPayloadValue) {
                if (array_key_exists($strPayloadValue['seg_id'], $arrBandwidthResponse)) {

                    $intActualUtilization = isset($arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_bw']) ? $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_bw'] : 0;
                    $intTotalUtilization = isset($arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_capacity']) ? $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_capacity'] : 0;

                    $strModuleName = 'CCSM';
                    // $intThresholdValue = 79;
                    // Yii::$app->formatter->asPercent(0.125, 2);
                    // pe($arrBandwidthResponse[$strPayloadValue['seg_id']]);

                    $intCurrentPercentage = Yii::$app->formatter->asPercent((($intActualUtilization + $strAffixUtilization) / $intTotalUtilization));
                    $intCurrentPercentage = str_replace('%', '', $intCurrentPercentage);
                    $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($strModuleName, $intCurrentPercentage);

                    $strCurrentStatus = 'rejected';
                    if ($bolGetThresholdCheckData['status'] == 'success') {
                        $strCurrentStatus = 'selected';
                        $strSuccessCounter++;
                    }
                    $arrPathDetails[$strPayloadKey]['status'] =  $strCurrentStatus;
                    $arrPathDetails[$strPayloadKey]['reason'] =  $bolGetThresholdCheckData['message'];
                    $arrPathDetails[$strPayloadKey]['segment_id'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['actual_time'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['actual_bw'] =  $intActualUtilization;
                    $arrPathDetails[$strPayloadKey]['actual_capacity'] =  $intTotalUtilization;
                    $arrPathDetails[$strPayloadKey]['peak_time'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['peak_bw'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['peak_capacity'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['avg_bw'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['percentile95_bw'] =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['segment_mapping'] =  $strPayloadValue['segement_mapping'];
                    $arrPathDetails[$strPayloadKey]['tag'] =  $strPayloadValue['tag'];
                }
            }

            $strPathStatus = 'rejected';
            $strPathMsg = 'Insufficient Bandwidth';
            if ($strSuccessCounter == count($arrPayloadData)) {
                $strPathStatus = 'selected';
                $strPathMsg = 'Sufficient Bandwidth';
                $strBwsStatusCheck++;
            }

            $arrBwsOutputLists[$strBwsIndexCounter]['path_status'] = $strPathStatus;
            $arrBwsOutputLists[$strBwsIndexCounter]['message'] = $strPathMsg;
            $arrBwsOutputLists[$strBwsIndexCounter]['path_detail'] = $arrPathDetails;
            $strBwsIndexCounter++;
            // echo '<pre>';print_r($arrOutputLists);die;
        }
        $strBwsStatus = 'Failed';
        $strBwsMsg = 'Bandwidth Service: criteria failed for provisioning.';
        // if ($strBwsStatusCheck == count($arrTopologyBestPathLists)) {
        if ($strBwsStatusCheck > 0) {
            $strBwsStatus = 'Success';
            $strBwsMsg = 'Bandwidth Service: criteria passed for provisioning.';
        }
        if ($strModuleName == 'BPA') {
            $arrOutputLists['CircuitID'] = 'MWRTN-P2P-62207-ABIS-P-C';
        }
        $arrOutputLists['status'] = $strBwsStatus;
        $arrOutputLists['statusMessage'] = $strBwsMsg;
        $arrOutputLists['bws_output'] = $arrBwsOutputLists;
        return $arrOutputLists;
    }

}