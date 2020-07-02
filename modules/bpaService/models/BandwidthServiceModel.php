<?php

namespace app\modules\bpaService\models;

use Yii;
use yii\base\Model;

class BandwidthServiceModel extends Model
{
    public $utilization;
    public $duration;
    public $duration_filter;    
    public $utilization_type;
    public $a_end_host;
    public $z_end_host;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration','duration_filter'], 'string', 'max' => '20'],
            [['utilization', 'utilization_type','a_end_host', 'z_end_host'], 'required'],            
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'utilization' => 'Select Utilization',
            'duration' => 'Select Duration',
            'duration_filter'  => 'Select Hour/Day',
            'utilization_type' => 'Type Of Utilization',
            'a_end_host' => 'A End',
            'z_end_host' => 'Z End',
        ];
    }

    public static function getUtilization()
    {
        return ["peak" => "peak", "average" => "average", "95precentile" => "95 precentile", "current" => "current"];
    }

    public static function getDuration()
    {
        return ["hour" => "hour", "day" => "day"];
    }

    public static function getUtilizationType()
    {
        return ["QOSclassbased" => "Class Based", "combined" => "Combined"];
    }
}
