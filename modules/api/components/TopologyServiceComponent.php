<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class TopologyServiceComponent
{
    public static function createPayloadData($arrRequestData = [])
    {
        $arrRequestData = '{"A_D":[{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20524","segement_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"21656"},{"source_hostname":"ABD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUF-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20525","segement_mapping":"ABD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUF-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"21656"},{"source_hostname":"AHJ-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISFNGJ-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20526","segement_mapping":"AHJ-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISFNGJ-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"21656"}],"W_Z":[{"source_hostname":"AHT-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MPE-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20527","segement_mapping":"AHT-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MPE-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"21656"},{"source_hostname":"AHK-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MQP-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20528","segement_mapping":"AHK-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MQP-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"21656"},{"source_hostname":"AUD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MKH-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20529","segement_mapping":"AUD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MKH-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"21656"}]}';
        return json_decode($arrRequestData, true);

        // $arrSegmentids = [];

        // foreach($arrRequestData as $strPath => $arrRequestLists){
        //     foreach($arrRequestLists as $strIndex => $arrRequest ){
        //         $arrSegmentids[] = $arrRequest['seg_id'];
        //     }
        // $arrSegmentids[] = ArrayHelper::getColumn($arrRequestLists, 'seg_id');
        // echo '<pre>';print_r($arrSegmentids);die;
        // } 
        // return $arrSegmentids;
        // echo '<pre>';print_r($arrSegmentids);die;
    }

    public static function getSegmentLists($arrRequestData)
    {
        $arrSegmentids = [];
        foreach ($arrRequestData as $strPath => $arrRequestLists) {
            foreach ($arrRequestLists as $strIndex => $arrRequest) {
                $arrSegmentids[] = $arrRequest['seg_id'];
            }
            // $arrSegmentids[] = ArrayHelper::getColumn($arrRequestLists, 'seg_id');
            // echo '<pre>';
            // print_r($arrSegmentids);
            // die;
        }
        return $arrSegmentids;
        // echo '<pre>';
        // print_r($arrSegmentids);
        // die;
    }
}
