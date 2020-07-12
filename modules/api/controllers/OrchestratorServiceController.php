<?php

namespace app\modules\api\controllers;

use Yii;
use yii\helpers\Json;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use app\modules\api\components\BaseController;
use app\modules\api\components\TopologyServiceComponent;
use app\modules\api\components\BandwidthServiceComponent;
use app\modules\api\components\OrchestratorComponent;
use app\modules\api\models\ApiLogs;

/**
 * OrchestratorService controller for the `api` module
 */
class OrchestratorServiceController extends BaseController
{
    private $moduleType = '';
    private $intCurrentBandwidth = '';
    private $strUniqueId = '';
    private $arrApiLogs = []; 

    public function actionGetBestPath()
    {
        $this->strUniqueId = uniqid();
        // ['SCCM', 'CCSM', 'BPA', 'SRA'];
        //Yii::$app->request->post() |  Yii::$app->request->queryParams; || Yii::$app->request->getRawBody()
        $jsonRequestData = Yii::$app->request->getRawBody();
        
        return $this->manipulatedRequestData($jsonRequestData);
    }

    private function manipulatedRequestData($jsonRequestData)
    {
        //$jsonRequestData = '{"module_type": "SRA","segment_ids":"[20525,20524,20526]","bandwidth_provision":"9000"}';
        //$jsonRequestData = '{"module_type": "SRA","source_hostname":"AHD-CGR-ISP-ACC-RTR-221","destination_hostname":"MUM-SC-ISPNGW-RTR-055"}';
        $jsonRequestData   =  '{"module_type": "CCSM","source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10"}';
        //$jsonRequestData   =  '{"module_type": "BPA","source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","bandwidth_provision":"9000"}';

        try {            
            $arrRequestData = Json::decode($jsonRequestData, true);
        } catch (InvalidArgumentException $jsonError) {
            $msg =  $jsonError->getMessage();
            return $this->apiResponse(401, 'Failed', $msg);
        }

        $objApiLogs = new ApiLogs();
        $objApiLogs->unique_id = $this->strUniqueId;
        $objApiLogs->app_type = $arrRequestData['module_type'];
        $objApiLogs->app_url = Url::base(true).'/api/orchestrator-service/get-best-path';
        $objApiLogs->request_method = 'POST';
        $objApiLogs->request = $jsonRequestData;

        // pe($objApiLogs);
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
                $arrSegmentBestPathLists = $this->apiNotMatched("Incomplete information, for which module you need data.");
                break;
        }

        $objApiLogs->response = json_encode($arrSegmentBestPathLists);
        $objApiLogs->save(false);
        unset($objApiLogs);
        return $arrSegmentBestPathLists;
    }

    private function getCcsmBestPath($jsonRequestData)
    {
        try {
            $arrRequestData = json::decode($jsonRequestData, true);
            $arrTopologyBestPathLists   = TopologyServiceComponent::getRankwisePath($jsonRequestData, $this->strUniqueId);
            $this->intCurrentBandwidth = '9000';

            if (!empty($arrTopologyBestPathLists)) {
                $arrSegmentLists    = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
                $arrPathsBandwidths = BandwidthServiceComponent::getAllUtilization($arrSegmentLists,$this->strUniqueId);
                $arrResponseResult  = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $this->moduleType, $this->intCurrentBandwidth);

                if ($arrResponseResult['status'] == 'Success') {
                    return $this->apiResponse(200, 'Success', $arrResponseResult);
                } else {
                    return $this->apiResponse(404, 'Failed', $arrResponseResult);
                }
            }
        } catch (InvalidArgumentException $jsonError) {
            $msg =  $jsonError->getMessage();
            return $this->apiResponse(401, 'Failed', $msg);
        }
    }

    private function getSraBestPath($jsonRequestData)
    {
        try {
            $arrRequestData = json::decode($jsonRequestData, true);
            $arrOutputResult = [];
            if (!empty($arrRequestData['bandwidth_provision']) && !empty($arrRequestData['segment_ids'])) {
                $this->intCurrentBandwidth = $arrRequestData['bandwidth_provision'];
                $arrSegments         = $arrRequestData['segment_ids'];
                $arrSegments         = json::decode($arrSegments);
                $arrPathsBandwidths  = BandwidthServiceComponent::getAllUtilization($arrSegments,$this->strUniqueId);
                $arrOutputResult     = OrchestratorComponent::setModulePathBandwidth($arrPathsBandwidths, $this->intCurrentBandwidth, $this->moduleType);
                $arrOutputResult['status'] = 'Success';
                // Need to discuss from where will get the best path.
                // $arrTopologyBestPathLists = [];
                // $arrOutputResult = OrchestratorComponent::calculateBestPath, $this->intCurrentBandwidth);
            } else if (!empty($arrRequestData['source_hostname']) && !empty($arrRequestData['destination_hostname'])) {
                $arrTopologyBestPathLists = TopologyServiceComponent::getRankwisePath($jsonRequestData, $this->strUniqueId);
                $this->intCurrentBandwidth = '9000';

                if (!empty($arrTopologyBestPathLists)) {
                    $arrSegmentLists    = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
                    $arrPathsBandwidths = BandwidthServiceComponent::getAllUtilization($arrSegmentLists,$this->strUniqueId);
                    $arrOutputResult    = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $this->moduleType, $this->intCurrentBandwidth);
                }
            }

            if ($arrOutputResult['status'] == 'Success') {
                return $this->apiResponse(200, 'Success', $arrOutputResult);
            } else {
                return $this->apiResponse(404, 'Failed', $arrOutputResult);
            }
        } catch (InvalidArgumentException $jsonError) {
            $msg =  $jsonError->getMessage();
            return $this->apiResponse(401, 'Failed', $msg);
        }
    }

    private function getBpaBestPath($jsonRequestData)
    {
        try {
            $arrRequestData = json::decode($jsonRequestData, true);
            $this->intCurrentBandwidth = $arrRequestData['bandwidth_provision'];
            $arrTopologyBestPathLists = TopologyServiceComponent::getRankwisePath($jsonRequestData, $this->strUniqueId);
            $arrSegmentLists          = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
            $arrPathsBandwidths       = BandwidthServiceComponent::getAllUtilization($arrSegmentLists,$this->strUniqueId);
            $arrOutputResult          = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $this->moduleType, $this->intCurrentBandwidth);
            if ($arrOutputResult['status'] == 'Success') {
                return $this->apiResponse(200, 'Success', $arrOutputResult);
            } else {
                return $this->apiResponse(404, 'Failed', $arrOutputResult);
            }
        } catch (InvalidArgumentException $jsonError) {
            $msg =  $jsonError->getMessage();
            return $this->apiResponse(401, 'Failed', $msg);
        }
    }


}
