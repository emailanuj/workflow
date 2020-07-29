<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Json;
use app\modules\api\models\ApiLogs;
use app\modules\api\components\CurlServiceComponent;

class TopologyServiceComponent
{
    private static $strTopologyServiceUrl = 'http://10.127.248.19:8000/allpath/path/';
    // private static $strTopologyServiceUrl = 'http://bharti-ts01:8000/allpath/path/';

    public static function getRankwisePath($jsonRequestData, $strUniqueId = '')
    {
        $rankwisePath = '{"result":[{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_SIR_966_1AC_B_CASR920R153","source_interface":"TenGigabitEthernet0/0/12","destination_hostname":"BGL_ESP_901_1AG_CASR9KTR126","destination_interface":"TenGigabitEthernet0/2/1/3","seg_id":"23888","bandwidth":0,"segement_mapping":"BGL_SIR_966_1AC_B_CASR920R153__TenGigabitEthernet0/0/12__BGL_ESP_901_1AG_CASR9KTR126__TenGigabitEthernet0/2/1/3","tag":"","status":"fail","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_ESP_901_1AG_CASR9KTR126","source_interface":"HundredGigE0/6/1/0.241","destination_hostname":"BGL_0RG_901_1AG_A_CASR9KTR136","destination_interface":"Bundle-Ether2.241","seg_id":"22430","bandwidth":0,"segement_mapping":"BGL_ESP_901_1AG_CASR9KTR126__HundredGigE0/6/1/0.241__BGL_0RG_901_1AG_A_CASR9KTR136__Bundle-Ether2.241","tag":"","status":"success","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_0RG_901_1AG_A_CASR9KTR136","source_interface":"TenGigabitEthernet0/7/0/8","destination_hostname":"BGL_ISA_939_1AC_B_CASR920R153","destination_interface":"TenGigabitEthernet0/0/15","seg_id":"25635","bandwidth":0,"segement_mapping":"BGL_0RG_901_1AG_A_CASR9KTR136__TenGigabitEthernet0/7/0/8__BGL_ISA_939_1AC_B_CASR920R153__TenGigabitEthernet0/0/15","tag":"","status":"success","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_SIR_966_1AC_B_CASR920R153","source_interface":"TenGigabitEthernet0/0/12","destination_hostname":"BGL_ESP_901_1AG_CASR9KTR126","destination_interface":"TenGigabitEthernet0/2/1/3","seg_id":"23888","bandwidth":0,"segement_mapping":"BGL_SIR_966_1AC_B_CASR920R153__TenGigabitEthernet0/0/12__BGL_ESP_901_1AG_CASR9KTR126__TenGigabitEthernet0/2/1/3","tag":"","status":"success","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_ESP_901_1AG_CASR9KTR126","source_interface":"TenGigabitEthernet0/0/0/4","destination_hostname":"BGL_GGL_901_2AC_M_CASR903R030","destination_interface":"TenGigabitEthernet0/1/0","seg_id":"22473","bandwidth":10,"segement_mapping":"BGL_ESP_901_1AG_CASR9KTR126__TenGigabitEthernet0/0/0/4__BGL_GGL_901_2AC_M_CASR903R030__TenGigabitEthernet0/1/0","tag":"","status":"success","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_GGL_901_2AC_M_CASR903R030","source_interface":"TenGigabitEthernet0/0/0","destination_hostname":"BGL_6SC_901_1AC_T_CASR920R030","destination_interface":"TenGigabitEthernet0/0/15","seg_id":"22871","bandwidth":0,"segement_mapping":"BGL_GGL_901_2AC_M_CASR903R030__TenGigabitEthernet0/0/0__BGL_6SC_901_1AC_T_CASR920R030__TenGigabitEthernet0/0/15","tag":"","status":"success","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_6SC_901_1AC_T_CASR920R030","source_interface":"TenGigabitEthernet0/0/12","destination_hostname":"BGL_SUN_901_2AC_M_CASR903R030","destination_interface":"TenGigabitEthernet0/0/0","seg_id":"24859","bandwidth":0,"segement_mapping":"BGL_6SC_901_1AC_T_CASR920R030__TenGigabitEthernet0/0/12__BGL_SUN_901_2AC_M_CASR903R030__TenGigabitEthernet0/0/0","tag":"","status":"success","message":""}},{"BGL_SSZ_917_1AC_B_CASR920R153@BGL_SSZ_919_1AC_B_CASR920R153":{"source_hostname":"BGL_0RG_901_1AG_A_CASR9KTR136","source_interface":"TenGigabitEthernet0/7/0/8","destination_hostname":"BGL_ISA_939_1AC_B_CASR920R153","destination_interface":"TenGigabitEthernet0/0/15","seg_id":"25635","bandwidth":0,"segement_mapping":"BGL_0RG_901_1AG_A_CASR9KTR136__TenGigabitEthernet0/7/0/8__BGL_ISA_939_1AC_B_CASR920R153__TenGigabitEthernet0/0/15","tag":"","status":"success","message":""}}]}';
        $rankwisePathResult = json_decode($rankwisePath, true);
        OrchestratorComponent::saveApiLogs($strUniqueId, self::$strTopologyServiceUrl, $jsonRequestData, $rankwisePath);
        return $rankwisePathResult["result"];

        $requestDataArr = json_decode($jsonRequestData, true);
        $arrRequest['url'] = self::$strTopologyServiceUrl;
        $arrRequest['data'] = Json::encode(
            ["parameter_list" => [
                "source_host" => $requestDataArr['source_hostname'],
                "source_interface" => $requestDataArr['source_interface'],
                "destination_host" => $requestDataArr['destination_hostname'],
                "destination_interface" => $requestDataArr['destination_interface'],
                "link_type" => "flap_link",
                "drop_link" => [],
                "drop_node" => [],
                "module_type" => $requestDataArr['module_type']
            ]]
        );
        $arrResponse =  CurlServiceComponent::postRequest($arrRequest);
        OrchestratorComponent::saveApiLogs($strUniqueId, $jsonRequestData, $arrResponse);
        return $arrResponse;
    }

    public static function getSegmentLists($arrRequestData)
    {
        $arrSegmentIds = [];
        foreach ($arrRequestData as $strPath => $arrRequestLists) {
            foreach ($arrRequestLists as $strIndex => $arrRequest) {
                if ($arrRequest['status'] == "success") {
                    $arrSegmentIds[] = $arrRequest['seg_id'];
                }
            }
        }
        return $arrSegmentIds;
    }
}
