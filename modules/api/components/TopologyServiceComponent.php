<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;

class TopologyServiceComponent
{

    public static function createPayloadData()
    {
        $arrData = [
            "aend_hostname"=> 'abc',
            "aend_intrface" => "inter1",
            "zend_hostname" => "7d",
            "zend_intrface" => "all"
        ];

        

    }

    public static function getSegmentLists()
    {
     

    }
}
