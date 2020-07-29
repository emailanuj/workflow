<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;
use linslin\yii2\curl;

class CurlServiceComponent
{
    /**
     * cURL GET example
     */
    public function getRequest()
    {
        //Init curl
        $curl = new curl\Curl();
        return $curl->get('http://example.com/');
    }


    public static function postRequest($arrRequest = [])
    {
        $arrOutputResponse = [];
        if (!empty($arrRequest)) {
            $curl = new curl\Curl();
            $arrOutputResponse = $curl->setOption(CURLOPT_POSTFIELDS, $arrRequest['data'])
                ->setOption(CURLOPT_SSL_VERIFYPEER, false)
                ->setOption(CURLOPT_SSL_VERIFYHOST, false)
                ->setOption(CURLOPT_RETURNTRANSFER, 1)
                ->setOption(CURLOPT_HTTPHEADER,['Content-Type:application/json'])
                ->post($arrRequest['url']);
        }

        // pe($arrOutputResponse);
        return json_decode($arrOutputResponse, true);
    }

    /**
     * cURL multiple POST example one after one
     */
    public function multipleRequest()
    {
        //Init curl
        $curl = new curl\Curl();

        //post http://example.com/
        $response = $curl->setOption(
            CURLOPT_POSTFIELDS,
            http_build_query(array(
                'myPostField' => 'value'
            ))
        )
            ->post('http://example.com/');


        //post http://example.com/, reset request before
        $response = $curl->reset()
            ->setOption(
                CURLOPT_POSTFIELDS,
                http_build_query(array(
                    'myPostField' => 'value'
                ))
            )
            ->post('http://example.com/');
    }

    // public function curl($url, $requestType = 'GET', $data = '', $headers = array(), $xmldata = FALSE) {

    //     $ch = curl_init($url);

    //     if (!empty($headers)) {
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     }
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_HEADER, 0);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //    if(strpos($url,"https://")!==false){	
    // 	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
    //    }
    //     if ($xmldata == TRUE) {
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    //     }
    //     $result = curl_exec($ch);
    //     $info = curl_getinfo($ch);

    //     curl_close($ch);

    //     return $result;
    // }

}
