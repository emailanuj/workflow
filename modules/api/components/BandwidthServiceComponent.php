<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use app\modules\api\components\CurlServiceComponent;

class BandwidthServiceComponent
{
    private static $bandwidthServiceUrl = 'http://bharti-bs01:5000/bws/api/v1/utilization';

    public static function getAllUtilization()
    {
        //https://jsonplaceholder.typicode.com/todos/
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids"=> [20524,20525],
            "class" => "false",
            "interval" => "7d",
            "type" => "all"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getActualUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = Json::encode([
            "segment_ids"=> [20524,20525],
            "class" => "false"
        ]);
        //http_build_query
        // echo '<pre>'; print_r($arrRequest);die;

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getActualClassUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids"=> [20524,20525],
            "class" => "true"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }

    public static function getPeakUtilization()
    {
        $arrRequest['url'] = self::$bandwidthServiceUrl;
        $arrRequest['data'] = [
            "segment_ids"=> [20524,20525],
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
            "segment_ids"=> [20524,20525],
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
            "segment_ids"=> [20524,20525],
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
            "segment_ids"=> [20524,20525],
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
            "segment_ids"=> [20524,20525],
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
            "segment_ids"=> [20524,20525],
            "class" => "true",
            "interval" => "7d",
            "type" => "pctl95"
        ];

        return CurlServiceComponent::postRequest($arrRequest);
    }
}
