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
        $arrSegmentBestPathLists = $this->getSegmentBestPath($arrRequestData);
        // pe($arrSegmentBestPathLists);
        // echo '<pre>'; print_r($arrSegmentBestPathLists); die;

        // $arrData = [];
        // $arrData = BandwidthServiceComponent::getActualUtilization();
        return $this->apiResponse(200, $arrSegmentBestPathLists, "Bandwidth Service: criteria passed for provisioning");
    }


    private function getSegmentBestPath($arrRequestData)
    {
        $arrTopologyBestPathLists = TopologyServiceComponent::createPayloadData($arrRequestData);
        // pe($arrTopologyBestPathLists);
        $arrSegmentLists = TopologyServiceComponent::getSegmentLists($arrTopologyBestPathLists);
        $arrBandwidthResponce = BandwidthServiceComponent::getAllUtilization($arrSegmentLists);
        // pe($arrBandwidthResponce);
        // echo '<pre>';
        // print_r($arrTopologyBestPathLists);
        // print_r($arrBandwidthResponce);
        // die;
        $strFlapedUtilization = '9000';
        // sra me bandwith milega jo add karna hai actual me.
        $arrOutputLists = [];


        $arrBwsOutputLists = [];
        $strBwsStatusCheck = 0;
        $strBwsIndexCounter = 0;
        foreach ($arrTopologyBestPathLists as $strHostKey => $arrPayloadData) {
            $arrPathDetails = [];
            $strSuccessCounter = 0;
            foreach ($arrPayloadData as $strPayloadKey => $strPayloadValue) {
                if (array_key_exists($strPayloadValue['seg_id'], $arrBandwidthResponce)) {

                    $intActualUtilization = isset($arrBandwidthResponce[$strPayloadValue['seg_id']]['actual_bw']) ? $arrBandwidthResponce[$strPayloadValue['seg_id']]['actual_bw'] : 0;
                    $intTotalUtilization = isset($arrBandwidthResponce[$strPayloadValue['seg_id']]['actual_capacity']) ? $arrBandwidthResponce[$strPayloadValue['seg_id']]['actual_capacity'] : 0;

                    $strModuleName = 'CCSM';
                    // $intThresholdValue = 79;
                    // Yii::$app->formatter->asPercent(0.125, 2);
                    // pe($arrBandwidthResponce[$strPayloadValue['seg_id']]);

                    $intCurrentPercentage = Yii::$app->formatter->asPercent((($intActualUtilization + $strFlapedUtilization) / $intTotalUtilization));
                    $intCurrentPercentage = str_replace('%', '', $intCurrentPercentage);
                    $bolGetThresholdCheckData = ThresholdSettings::boolCheckThresholdPercentage($strModuleName, $intCurrentPercentage);

                    $strCurrentStatus = 'rejected';
                    if ($bolGetThresholdCheckData['status'] == 'success') {
                        $strCurrentStatus = 'success';
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

        $arrOutputLists['status'] = $strBwsStatus;
        $arrOutputLists['statusMessage'] = $strBwsMsg;
        $arrOutputLists['bws_output'] = $arrBwsOutputLists;

        pe($arrOutputLists);
        return $arrOutputLists;
        // return $this->getBandwidthService($arrSegmentLists);
    }

    // private function getBandwidthService($arrSegmentIdLists)
    // {
    //     return BandwidthServiceComponent::getActualUtilization($arrSegmentIdLists);
    // }
}
