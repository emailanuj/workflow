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
}
