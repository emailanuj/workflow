<?php

namespace app\modules\api\components;

use Yii;
use yii\helpers\Json;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\modules\api\models\ApiLogs;
use app\modules\api\components\CurlServiceComponent;
use app\modules\api\components\OrchestratorComponent;

class PolicyManagerServiceComponent
{
    private static $strPolicyManagerServiceUrl = 'http://localhost/policymanager/web/api/threshold-service/threshold';

    public function getThresholdSettings($strModuleName, $network, $service, $utilization,  $intCurrentPercentage) {
        $requestArr = array("module_type" => $strModuleName, "network" => $network,"service" => $service,"utilization" => $utilization,"current_bandwidth" =>  $intCurrentPercentage);
        $jsonRequestData = json_encode($requestArr);
        $arrRequest['url'] = self::$strPolicyManagerServiceUrl;
        $arrRequest['data'] = Json::encode(
            [                     
                "module_type" => $strModuleName,
                "network"=> $network,
                "service"=> $service,
                "utilization"=> $utilization,
                "current_precentage"=> $intCurrentPercentage
            ]
        );        
        $arrResponse =  CurlServiceComponent::postRequest($arrRequest); 
       // OrchestratorComponent::saveApiLogs(uniqid(), $jsonRequestData, $arrResponse); 
        return $arrResponse;
    }
}
