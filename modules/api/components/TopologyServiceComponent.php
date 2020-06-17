<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Exception;

class TopologyServiceComponent
{
    public function getSegmentLists()
    {
        $arrData = [
            "aend_hostname"=> [20524,20525],
            "aend_intrface" => "false",
            "zend_hostname" => "7d",
            "zend_intrface" => "all"
        ];
    }

}