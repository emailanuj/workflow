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
    private $moduleType = '';
    private $intCurrentBandwidth = '';

    public function actionGetBestPath()
    {
        // ['SCCM', 'CCSM', 'BPA', 'SRA'];
        //Yii::$app->request->post() |  Yii::$app->request->queryParams; || Yii::$app->request->getRawBody()
        $jsonRequestData = Yii::$app->request->getRawBody();
        return $this->manipulatedRequestData($jsonRequestData);
    }

    private function manipulatedRequestData($jsonRequestData)
    {
        // $bpaRequest = '{"status":"Success","code":"2001","OrderNumber":223006,"OrderId":"6df67f79-0640-59c2-83c7-208149e7aff5","data":[{"CircuitID":"MWRTN-P2P-62208-ABIS-P-C","status":"Success","message":"Bandwidth Service: criteria passed for provisioning","bws_output":[{"configured_capacity":100000.0,"peak_time":"2020-03-31 21:00:49","peak_value":0.743,"segment_id":22042,"segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":1,"utilization_actual":0.743},{"configured_capacity":100000.0,"peak_time":"2020-03-31 21:00:49","peak_value":0.743,"segment_id":22043,"segment_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUMSC-ISP-NGW-RTR-055__et-11/1/0.10","tag":1,"utilization_actual":0.743}]},{"CircuitID ":"MWRTN - P2P - 62205 - ABIS - P - C ","status":"","Success":"","message ":"","Bandwidth Service":"criteria passed","for provisioning ":"","bws_output ":[{"configured_capacity ":100000.0,"peak_time ":"2020 - 03 - 31 21: 00: 49 ","peak_value ":0.743,"segment_id ":22010,"segment_mapping ":"AHD - CGR - ISP - ACC - RTR - 221 __et - 0 / 1 / 1.10 __MUM - SC - ISPNGW - RTR - 055 __et - 11 / 1 / 0.10 ","tag ":1,"utilization_actual ":0.743},{"configured_capacity ":100000.0,"peak_time ":"2020 - 03 - 31 21: 00: 49 ","peak_value ":0.743,"segment_id ":22011,"segment_mapping ":"AHD - CGR - ISP - ACC - RTR - 221 __et - 0 / 1 / 1.10 __MUMSC - ISP - NGW - RTR - 055 __et - 11 / 1 / 0.10 ","tag ":1,"utilization_actual ":0.743}]}]}';
        // $jsonRequestData = '{"segment_ids":"[20525,20524,20526]","bandwidth_provision":"9000"}';
        //$jsonRequestData = '{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","destination_hostname":"MUM-SC-ISPNGW-RTR-055"}';
        // $jsonRequestData   =  '{"module_type": "CCSM","source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10"}';
        $arrRequestData = json_decode($jsonRequestData, true);

        switch ($arrRequestData['module_type']) {
            case "BPA":
                $this->moduleType = 'BPA';
                $arrSegmentBestPathLists = $this->getBpaBestPath($jsonRequestData);
                break;

            case "SRA":
                $this->moduleType = 'SRA';
                $arrSegmentBestPathLists = $this->getSraBestPath($jsonRequestData);
                break;

            case "CCSM":
                $this->moduleType = 'CCSM';
                $arrSegmentBestPathLists = $this->getCcsmBestPath($jsonRequestData);
                break;

            default:
                $arrSegmentBestPathLists = $this->apiNotMached("Incompleate information, for which module you need data.");
                break;
        }
        return $arrSegmentBestPathLists;
    }

    private function getCcsmBestPath($jsonRequestData)
    {
        try {
            // get flap link's bandwidth
            $arrTopologyBestPathLists   = TopologyServiceComponent::getRankwisePath($jsonRequestData);
            $this->intCurrentBandwidth = '9000';

            if (!empty($arrTopologyBestPathLists)) {
                $arrSegmentLists    = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
                $arrPathsBandwidths = BandwidthServiceComponent::getAllUtilization($arrSegmentLists);
                $arrResponseResult = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths);
                
                if($arrResponseResult['status'] == 'Success'){
                    return $this->apiResponse(200, 'Success' , $arrResponseResult);
                } else{
                    return $this->apiResponse(404,'Failed', $arrResponseResult);
                }
            }
        } catch (InvalidArgumentException $jsonError) {
            return $jsonError->getMessage();
        }
    }

    private function getSraBestPath($jsonRequestData)
    {
        try {
            $arrRequestData = json::decode($jsonRequestData, true);
            
            $arrOutputResult = [];
            if (!empty($arrRequestData['bandwidth_provision']) && !empty($arrRequestData['segment_ids'])) {
                $this->intCurrentBandwidth = $arrRequestData['bandwidth_provision'];
                $arrPathsBandwidths         = BandwidthServiceComponent::getAllUtilization($arrRequestData['segment_ids']);
                // Need to discuss from where will get the best path.
                $arrTopologyBestPathLists = [];
                $arrOutputResult = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths);
            } else if (!empty($arrRequestData['source_hostname']) && !empty($arrRequestData['destination_hostname'])) {
                $arrTopologyBestPathLists = TopologyServiceComponent::getRankwisePath($arrRequestData);
                $this->intCurrentBandwidth = '9000';

                if (!empty($arrTopologyBestPathLists)) {
                    $arrSegmentLists    = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
                    $arrPathsBandwidths         = BandwidthServiceComponent::getAllUtilization($arrSegmentLists);
                    $arrOutputResult = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths);
                }
            }

            if($arrOutputResult['status'] == 'Success'){
                return $this->apiResponse(200, 'Success' , $arrOutputResult);
            } else{
                return $this->apiResponse(404,'Failed', $arrOutputResult);
            }
        } catch (InvalidArgumentException $jsonError) {
            return $jsonError->getMessage();
        }
    }

    private function getBpaBestPath($jsonRequestData)
    {
        try {
            $arrRequestData = json::decode($jsonRequestData, true);
            $this->intCurrentBandwidth = $arrRequestData['bandwidth_provision'];
            $arrTopologyBestPathLists = TopologyServiceComponent::getRankwisePath($arrRequestData);
            $arrPathsBandwidths       = $this->getModulePathBandwidth($arrTopologyBestPathLists, $arrSegments = []);
            $arrOutputLists           = $this->calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths);
        } catch (InvalidArgumentException $jsonError) {
            return $jsonError->getMessage();
        }

        return $arrOutputLists;
    }

    private function calculateBestPath($arrBestPathLists, $arrBandwidthResponse)
    {
        $arrOutputLists = $arrBwsOutputLists = [];
        $strBwsStatusCheck = 0;
        $strBwsIndexCounter = 0;
        // echo '<pre>'; print_r($arrBestPathLists); print_r($arrBandwidthResponse);die;
        foreach ($arrBestPathLists as $arrPayloadData) {
            $arrPathDetails = [];
            $strSuccessCounter = 0;
            foreach ($arrPayloadData as $strPayloadKey => $strPayloadValue) {
                if (array_key_exists($strPayloadValue['seg_id'], $arrBandwidthResponse)) {

                    $intActualUtilization = isset($arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_bw']) ? $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_bw'] : 0;
                    $intTotalUtilization = isset($arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_capacity']) ? $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_capacity'] : 0;
                    $intCurrentPercentage = Yii::$app->formatter->asPercent((($intActualUtilization + $this->intCurrentBandwidth) / $intTotalUtilization));
                    $intCurrentPercentage = str_replace('%', '', $intCurrentPercentage);
                    $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($this->moduleType, $intCurrentPercentage);

                    $strCurrentStatus = 'rejected';
                    if ($bolGetThresholdCheckData['status'] == 'success') {
                        $strCurrentStatus = 'selected';
                        $strSuccessCounter++;
                    }
                    $arrPathDetails[$strPayloadKey]['status']           =  $strCurrentStatus;
                    $arrPathDetails[$strPayloadKey]['reason']           =  $bolGetThresholdCheckData['message'];
                    $arrPathDetails[$strPayloadKey]['segment_id']       =  $strPayloadValue['seg_id'];
                    $arrPathDetails[$strPayloadKey]['actual_time']      =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['actual_time'];
                    $arrPathDetails[$strPayloadKey]['actual_bw']        =  $intActualUtilization;
                    $arrPathDetails[$strPayloadKey]['actual_capacity']  =  $intTotalUtilization;
                    $arrPathDetails[$strPayloadKey]['peak_time']        =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['peak_time'];
                    $arrPathDetails[$strPayloadKey]['peak_bw']          =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['peak_bw'];
                    $arrPathDetails[$strPayloadKey]['peak_capacity']    =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['peak_capacity'];
                    $arrPathDetails[$strPayloadKey]['avg_bw']           =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['avg_bw'];
                    $arrPathDetails[$strPayloadKey]['percentile95_bw']  =  $arrBandwidthResponse[$strPayloadValue['seg_id']]['percentile95_bw'];
                    $arrPathDetails[$strPayloadKey]['segment_mapping']  =  isset($strPayloadValue['segement_mapping']) ? $strPayloadValue['segement_mapping'] : '';
                    $arrPathDetails[$strPayloadKey]['tag']              =  isset($strPayloadValue['tag']) ? $strPayloadValue['tag'] : '';
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

        if($this->moduleType == 'BPA'){
            $arrOutputLists['CircuitID'] = "MWRTN-P2P-62207-ABIS-P-C";    
        }
        $arrOutputLists['status']           = $strBwsStatus;
        $arrOutputLists['statusMessage']    = $strBwsMsg;
        $arrOutputLists['bws_output']       = $arrBwsOutputLists;
        return $arrOutputLists;
    }
}
