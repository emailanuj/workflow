<?php

namespace app\modules\bpaService\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "bpaService".
 *
 * @property int $step_no
 * @property string|null $if_fail
 * @property string|null $a_end_host
 */

class BandwidthServiceModel extends Model
{
    public $utilization = [];
    public $duration = [];
    public $duration_filter = [];    
    public $utilization_type = [];
    public $a_end_host = [];
    public $z_end_host = [];


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['utilization', 'duration', 'duration_filter', 'utilization_type','a_end_host', 'z_end_host'], 'each', 'rule' => ['required']]            
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

    // public static function getHours()
    // {
    //     $hours = range(1,24);
    //     return $hours;
    // }

    // public static function getDays()
    // {
    //     $days = range(1,30);
    //     return $days;
    // }

    public static function getUtilizationType()
    {
        return ["QOSclassbased" => "Class Based", "combined" => "Combined"];
    }
}
