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
    protected $serviceType = '';
    protected $circuitId = '';

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
        
        // BPA use cases L3vpn, L2VPN
        //$jsonRequestData   =  '{"module_type": "BPA","source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","bandwidth_provision":"9000"}';
        
        // BPA L3VPN
        //$jsonRequestData = '{"module_type": "BPA","formData":{"patch":[{"ckt-id":"AAA-ML3-1-5","ra":657894,"service-type":"MPLS-L3","modify":[{"interfaces":{"interface":[{"role":"primary","pe":"MNRLAB-MPL-PE-RTR-75","interface":"TenGigE0/7/1/8","wan-ip-pe":"172.30.76.1/30"}],"ethernet":{"svlan":503,"cvlan":504}},"qos":{"bandwidth":23552,"policy-maps":{"ingress-name":"XXXXXXX","egress-name":"YYYYYY"}}}]}]}}';
        
        // BPA L2VPN
        //$jsonRequestData  = '{"module_type": "BPA","mpls-l2vpn-cfs:mpls-l2vpn":[{"src":{"access":[{"interface":{"intf-id":"GigabitEthernet0/4/3"},"device":"CHN_NUG_931_1AC_CASR903R341"}]},"service":{"business":{"type":"tng"}},"ckt-id":"TYRQ-ANG1639737","destn":{"access":[{"interface":{"intf-id":"GigabitEthernet0/0/11"},"device":"CHN_SRN_901_1AC_T_CASR920R458"}]},"bandwidth":"102400","downtime":"false","order":{"date-of-provisioning":"02042020","ra":3416760,"lsi":"13526474"}}]}';
        //$jsonRequestData =  '{"module_type": "BPA","mpls-l2vpn-cfs:mpls-l2vpn":[{"src":{"access":[{"interface":{"intf-id":"cem 1/26:126","mux-hostname":"CHN_SCS_939_1AC_CASR903R302"},"device":"CHN_SCS_939_1AC_CASR903R302"}]},"service":{"mobility":{"type":"2G-L2"}},"ckt-id":"MWRTN-P2P-61670-ABIS-P-C","destn":{"access":[{"interface":{"intf-id":"cem 0/4/0/41:141","mux-hostname":"CHN_KAN_903_1AC_M_CASR903R416"},"device":"CHN_KAN_903_1AC_M_CASR903R416"}]},"bandwidth":"4096","downtime":"false","transactionId":"None","order":{"date-of-provisioning":"03042020","ra":218300,"lsi":"0"}}]}';

        try {            
            $arrRequestData = Json::decode($jsonRequestData, true);
            //pe($arrRequestData);
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
                if(array_key_exists('formData', $arrRequestData)) {
                    $this->serviceType = $arrRequestData['formData']['patch'][0]['service-type'];
                    $this->circuitId = $arrRequestData['formData']['patch'][0]['ckt-id'];
                    $this->intCurrentBandwidth = $arrRequestData['formData']['patch'][0]['modify'][0]['qos']['bandwidth'];
                } else if($arrRequestData['mpls-l2vpn-cfs:mpls-l2vpn']) {
                    $this->serviceType = 'mpls-l2vpn';
                    $this->circuitId = $arrRequestData['mpls-l2vpn-cfs:mpls-l2vpn'][0]['ckt-id'];
                    $this->intCurrentBandwidth = $arrRequestData['mpls-l2vpn-cfs:mpls-l2vpn'][0]['bandwidth'];
                } else {

                }
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
                $arrResponseResult  = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $this->moduleType, $this->intCurrentBandwidth, $this->serviceType, $this->circuitId);

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
                $arrOutputResult     = OrchestratorComponent::setModulePathBandwidth($arrPathsBandwidths, $this->intCurrentBandwidth, $this->moduleType, $this->serviceType);
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
                    $arrOutputResult    = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $this->moduleType, $this->intCurrentBandwidth, $this->serviceType, $this->circuitId);
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
            $arrTopologyBestPathLists = TopologyServiceComponent::getRankwisePath($jsonRequestData, $this->strUniqueId);
            $arrSegmentLists          = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
            $arrPathsBandwidths       = BandwidthServiceComponent::getAllUtilization($arrSegmentLists,$this->strUniqueId);
            $arrOutputResult          = OrchestratorComponent::calculateBestPath($arrTopologyBestPathLists, $arrPathsBandwidths, $this->moduleType, $this->intCurrentBandwidth, $this->serviceType, $this->circuitId);
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
