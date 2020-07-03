<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use app\modules\api\components\CurlServiceComponent;
use yii\helpers\ArrayHelper;

class BandwidthServiceComponent
{
    private static $bandwidthServiceUrl = 'http://bharti-bs01:5000/bws/api/v1/utilization';


    public static function getAllUtilization($arrSegmentId)
    {
        // pe($arrSegmentId);
        //https://jsonplaceholder.typicode.com/todos/
        // $arrRequest['url'] = self::$bandwidthServiceUrl;
        // $arrRequest['data'] = Json::encode([
        //     "segment_ids" => $arrSegmentId,
        //     "class" => "false",
        //     "interval" => "20d",
        //     "type" => "all"
        // ]);
        // $arrResponse = CurlServiceComponent::postRequest($arrRequest);
        // return ArrayHelper::index($arrResponse, 'segment_id');
        $strStaticResponce = '{"20525":{"segment_id":20525,"actual_time":"2020-06-07 23:45:03","actual_bw":21101.369,"actual_capacity":200000,"peak_time":"2020-06-03 15:15:04","peak_bw":29956.945,"peak_capacity":200000,"avg_bw":19646.6313902728,"percentile95_bw":27231.959},"20524":{"segment_id":20524,"actual_time":"2020-06-07 23:45:03","actual_bw":31791.809,"actual_capacity":100000,"peak_time":"2020-06-04 15:30:05","peak_bw":39413.121,"peak_capacity":100000,"avg_bw":27028.5380486358,"percentile95_bw":37258.375},"20529":{"segment_id":20529,"actual_time":"2020-06-07 23:45:03","actual_bw":0.016,"actual_capacity":10000,"peak_time":null,"peak_bw":null,"peak_capacity":null,"avg_bw":0.0159243499,"percentile95_bw":0.016},"20528":{"segment_id":20528,"actual_time":"2020-06-07 23:45:03","actual_bw":2.513,"actual_capacity":10000,"peak_time":"2020-06-04 06:15:03","peak_bw":160.869,"peak_capacity":10000,"avg_bw":11.6381867612,"percentile95_bw":22.6775},"20527":{"segment_id":20527,"actual_time":"2020-06-07 23:45:03","actual_bw":6085.658,"actual_capacity":100000,"peak_time":"2020-06-05 22:30:03","peak_bw":7123.063,"peak_capacity":100000,"avg_bw":4673.9113743243,"percentile95_bw":6593.0362},"20526":{"segment_id":20526,"actual_time":"2020-06-07 23:45:03","actual_bw":29432.063,"actual_capacity":200000,"peak_time":"2020-06-05 12:15:03","peak_bw":39693.363,"peak_capacity":200000,"avg_bw":30292.6193677343,"percentile95_bw":37899.7771}}';
        return json_decode($strStaticResponce, true);
    }


    public static function getActualUtilization($arrSegmentId)
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = Json::encode([
            // "segment_ids" => [20524, 20525],
            "segment_ids" => $arrSegmentId,
            "class" => "false"
        ]);
        //http_build_query
        // echo '<pre>'; print_r($arrRequest);die;

        $arrResponse =  CurlServiceComponent::postRequest($arrRequest);

        return ArrayHelper::index($arrResponse, 'segment_id');
    }

    public static function getActualClassUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => [20524, 20525],
            "class" => "true"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getPeakUtilization($arrSegmentId)
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => $arrSegmentId,
            "class" => "false",
            "interval" => "7d",
            "type" => "peak"
        ];
        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getPeakClassUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => [20524, 20525],
            "class" => "true",
            "interval" => "7d",
            "type" => "peak"
        ];
        return CurlServiceComponent::postRequest($arrRequest);        
    }

    public static function getAverageUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => [20524, 20525],
            "class" => "false",
            "interval" => "7d",
            "type" => "avg"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getAverageClassUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => [20524, 20525],
            "class" => "true",
            "interval" => "7d",
            "type" => "avg"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function get95PercentileUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => [20524, 20525],
            "class" => "false",
            "interval" => "7d",
            "type" => "pctl95"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function get95PercentileClassUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids" => [20524, 20525],
            "class" => "true",
            "interval" => "7d",
            "type" => "pctl95"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getBwsUtilizationData($utlizationPostData) {  
        //pe($utlizationPostData); exit;
        $interval = $utlizationPostData['duration_filter'].$utlizationPostData['duration'];
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        if(!empty($utlizationPostData['utilization'])) {
            if($utlizationPostData['utilization'] == 'current') {
                
                $arrRequest['data'] = [
                    "segment_ids" => $utlizationPostData['segment_ids'],
                    "class" => $utlizationPostData['utilization_type']
                ];
                /**actual */
                $classfalse = '[{"segment_id":20525,"timestamp":"2020-06-07 23:45:03","actual_bw":21101.369,"configured_capacity":200000.0},{"segment_id":20524,"timestamp":"2020-06-07 23:45:03","actual_bw":31791.809,"configured_capacity":100000.0},{"segment_id":20526,"timestamp":"2020-06-07 23:45:03","actual_bw":29432.063,"configured_capacity":200000.0}]';
                $classtrue  = '[{"segment_id":20525,"timestamp":"2020-06-07 23:45:03","class_actual_bw":{"CORE_NETWORK_OAM_OUT":0.061,"CLASS-DEFAULT":5821.881,"CORE_MOBILITY_DATA_OUT":13218.498,"CORE_MOBILITY_SIGNAL_OUT":29.843,"CORE_PREMIUM_NRT_OUT":1294.554,"CORE_PREMIUM_RT_OUT":813.866,"CORE_NETWORK_OUT":1.164}},{"segment_id":20524,"timestamp":"2020-06-07 23:45:03","class_actual_bw":{"CORE_NETWORK_OAM_OUT":0.002,"CLASS-DEFAULT":14983.873,"CORE_MOBILITY_DATA_OUT":8506.123,"CORE_MOBILITY_SIGNAL_OUT":22.435,"CORE_PREMIUM_NRT_OUT":7242.605,"CORE_PREMIUM_RT_OUT":1434.278,"CORE_NETWORK_OUT":1.42}}]';
                /**actual */
            }  else {
                $arrRequest['data'] = [
                    "segment_ids" => $utlizationPostData['segment_ids'],
                    "class" => $utlizationPostData['utilization_type'],
                    "interval" => $interval,
                    "type" => $utlizationPostData['utilization']
                ];
                /**peak */
                $classfalse = '[{"segment_id":20525,"timestamp":"2020-06-03 15:15:04","peak_bw":29956.945,"configured_capacity":200000.0},{"segment_id":20524,"timestamp":"2020-06-04 15:30:05","peak_bw":39413.121,"configured_capacity":100000.0}]';
                $classtrue = '[{"segment_id":20524,"class_peak_bw":{"CORE_NETWORK_OAM_OUT":[{"utilization":0.008},{"timestamp":"2020-06-01 10:00:04"}],"CLASS-DEFAULT":[{"utilization":1584.969},{"timestamp":"2020-05-28 20:30:04"}],"CORE_MOBILITY_DATA_OUT":[{"utilization":1339.259},{"timestamp":"2020-05-27 21:45:04"}],"CORE_MOBILITY_SIGNAL_OUT":[{"utilization":11.038},{"timestamp":"2020-05-26 18:45:04"}],"CORE_PREMIUM_NRT_OUT":[{"utilization":667.546},{"timestamp":"2020-05-27 21:45:04"}],"CORE_PREMIUM_RT_OUT":[{"utilization":377.049},{"timestamp":"2020-05-28 20:30:04"}],"CORE_NETWORK_OUT":[{"utilization":1.27},{"timestamp":"2020-05-28 20:30:04"}]}},{"segment_id":20525,"class_peak_bw":{"CORE_NETWORK_OAM_OUT":[{"utilization":96.703},{"timestamp":"2020-06-01 10:00:04"}],"CLASS-DEFAULT":[{"utilization":8054.187},{"timestamp":"2020-05-27 21:45:04"}],"CORE_MOBILITY_SIGNAL_OUT":[{"utilization":71.737},{"timestamp":"2020-05-26 18:45:04"}],"CORE_PREMIUM_RT_OUT":[{"utilization":1311.523},{"timestamp":"2020-05-28 20:30:04"}],"CORE_PREMIUM_NRT_OUT":[{"utilization":2476.039},{"timestamp":"2020-05-27 21:45:04"}],"CORE_MOBILITY_DATA_OUT":[{"utilization":16234.479},{"timestamp":"2020-05-27 21:45:04"}],"CORE_NETWORK_OUT":[{"utilization":3.088},{"timestamp":"2020-06-01 10:00:04"}]}}]';
                /**peak */

                /**avg */
                //$classfalse = '[{"segment_id":20525,"avg_bw":18835.523067148},{"segment_id":20524,"avg_bw":26254.9740115523}]';
                //$classtrue = '[{"segment_id":20525,"class_avg_bw":{"CORE_NETWORK_OAM_OUT":0.2528049505,"CLASS-DEFAULT":5387.9354326733,"CORE_PREMIUM_RT_OUT":979.7637910891,"CORE_MOBILITY_DATA_OUT":10413.2637148515,"CORE_MOBILITY_SIGNAL_OUT":52.3928970297,"CORE_PREMIUM_NRT_OUT":1635.0842643564,"CORE_NETWORK_OUT":1.6765524752}},{"segment_id":20524,"class_avg_bw":{"CORE_NETWORK_OAM_OUT":0.0344752475,"CLASS-DEFAULT":11791.8003504951,"CORE_PREMIUM_RT_OUT":1504.0148148515,"CORE_MOBILITY_SIGNAL_OUT":32.8247811881,"CORE_PREMIUM_NRT_OUT":6676.976390099,"CORE_MOBILITY_DATA_OUT":5840.8199415842,"CORE_NETWORK_OUT":2.7666960396}}]';
                /**avg */

                /**95precent */
                //$classfalse = '[{"segment_id":20525,"percentile95_bw":27231.959},{"segment_id":20524,"percentile95_bw":37060.6106}]';
                //$classtrue = '[{"segment_id":20525,"class_percentile95_bw":{"CORE_NETWORK_OAM_OUT":1.04165,"CLASS-DEFAULT":7736.05635,"CORE_PREMIUM_RT_OUT":1276.51055,"CORE_MOBILITY_DATA_OUT":16273.23005,"CORE_MOBILITY_SIGNAL_OUT":76.38885,"CORE_PREMIUM_NRT_OUT":2883.8923,"CORE_NETWORK_OUT":2.66475}},{"segment_id":20524,"class_percentile95_bw":{"CORE_NETWORK_OAM_OUT":0.14555,"CLASS-DEFAULT":18199.9708,"CORE_PREMIUM_RT_OUT":1689.89555,"CORE_MOBILITY_SIGNAL_OUT":59.2166,"CORE_PREMIUM_NRT_OUT":9422.4919,"CORE_MOBILITY_DATA_OUT":8871.3648,"CORE_NETWORK_OUT":6.12675}}]';
                /**95precent */
            }
        }

        return json_decode($classtrue,true);        
        //return CurlServiceComponent::postRequest($arrRequest); 

    }
}
