<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class TopologyServiceComponent
{

    public static function getRankwisePath($arrRequestData)
    {
        // Rankwise Path API
        $rankwisePath = '{"A_D":[{"source_hostname":"AHD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20524","segement_mapping":"AHD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"2656"},{"source_hostname":"ABD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUF-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20525","segement_mapping":"ABD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUF-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"5656"},{"source_hostname":"AHJ-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MUM-SC-ISFNGJ-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20526","segement_mapping":"AHJ-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MUM-SC-ISFNGJ-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"6656"}],"W_Z":[{"source_hostname":"AHT-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MPE-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20527","segement_mapping":"AHT-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MPE-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"3656"},{"source_hostname":"AHK-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MQP-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20528","segement_mapping":"AHK-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MQP-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"7656"},{"source_hostname":"AUD-CGR-ISP-ACC-RTR-221","source_interface":"et-0/1/1.10","destination_hostname":"MKH-SC-ISPNGW-RTR-055","destination_interface":"et-11/1/0.10","seg_id":"20529","segement_mapping":"AUD-CGR-ISP-ACC-RTR-221__et-0/1/1.10__MKH-SC-ISPNGW-RTR-055__et-11/1/0.10","tag":"1","bandwidth":"4656"}]}';
        return json_decode($rankwisePath, true);
    }

    public static function getSegmentLists($arrRequestData)
    {
        $arrSegmentIds = [];
        foreach ($arrRequestData as $strPath => $arrRequestLists) {
            foreach ($arrRequestLists as $strIndex => $arrRequest) {
                $arrSegmentIds[] = $arrRequest['seg_id'];
            }
            // $arrSegmentIds[] = ArrayHelper::getColumn($arrRequestLists, 'seg_id');            
        }
        return $arrSegmentIds;
    }
}
