<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\modules\threshold\models\ThresholdSettings;

class OrchestratorComponent
{

    public static function calculateBestPath($arrBestPathLists, $arrBandwidthResponse, $moduleType, $intCurrentBandwidth, $serviceNetwork, $circuitId)
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

                    // to avoid code replication
                    $sendBandwidthArray = array($strPayloadValue['seg_id'] => $arrBandwidthResponse[$strPayloadValue['seg_id']]);
                    $bandwidthDetails = self::setModulePathBandwidth($sendBandwidthArray, $intCurrentBandwidth, $moduleType, $serviceNetwork, $circuitId);
                    $arrPathDetails[$strPayloadKey] = $bandwidthDetails;
                    if ($arrPathDetails[$strPayloadKey][$strPayloadValue['seg_id']]['status'] == 'selected') {
                        $strSuccessCounter++;
                    }                    
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

        if ($moduleType == 'BPA') {
            $arrOutputLists['CircuitID'] = $circuitId;
        }
        $arrOutputLists['status']           = $strBwsStatus;
        $arrOutputLists['statusMessage']    = $strBwsMsg;
        $arrOutputLists['bws_output']       = $arrBwsOutputLists;
        return $arrOutputLists;
    }

    public static function setModulePathBandwidth($arrBandwidthResponse, $intCurrentBandwidth, $moduleType, $serviceNetwork)
    {
        /** in case of BPA check threshold on the basis of service,network,utilization 
         * settings done under threshold settings
         * currently we are accessing actual utilization only , in future we will fire all utilization for BPA */
        foreach ($arrBandwidthResponse as $bandwidthKey => $bandwidthValue) {
            $strModuleName = $moduleType;
            $intActualUtilization = isset($bandwidthValue['actual_bw']) ? $bandwidthValue['actual_bw'] : 0;
            $intTotalUtilization = isset($bandwidthValue['actual_capacity']) ? $bandwidthValue['actual_capacity'] : 0;

            $intCurrentPercentage = Yii::$app->formatter->asPercent((($intActualUtilization + $intCurrentBandwidth) / $intTotalUtilization));
            $intCurrentPercentage = str_replace('%', '', $intCurrentPercentage);
            if($strModuleName == 'BPA') {
                $seviceNetworkArr = explode('-',$serviceNetwork);
                $network = $seviceNetworkArr[0]; $service = $seviceNetworkArr[1];
                $utilization = 'actual';
                $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($strModuleName, $network, $service, $utilization,  $intCurrentPercentage);
            } else {
                $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($strModuleName, $network=NULL, $service=NULL, $utilization=NULL, $intCurrentPercentage);
            }
            $strCurrentStatus = 'rejected';
            if ($bolGetThresholdCheckData['status'] == 'success') {
                $strCurrentStatus = 'selected';
            }
            $arrBandwidthResponse[$bandwidthKey]['status']       =  $strCurrentStatus;
            $arrBandwidthResponse[$bandwidthKey]['reason']       =  $bolGetThresholdCheckData['message'];
            $arrBandwidthResponse[$bandwidthKey]['actual_bw']    =  $intActualUtilization;
            $arrBandwidthResponse[$bandwidthKey]['actual_capacity']  =  $intTotalUtilization;
        }
        return  $arrBandwidthResponse;
    }
}
