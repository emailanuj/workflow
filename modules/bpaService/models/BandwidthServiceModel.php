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

    public $network;
    public $service;
    public $tag;
    public $utilization;
    public $duration;
    public $hour_duration;
    public $day_duration;
    public $utilization_type;
    public $a_end_host = [];
    public $z_end_host = [];


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['network','service','tag','utilization', 'duration', 'utilization_type'], 'required'], 
            [['a_end_host', 'z_end_host'], 'each', 'rule' => ['required']],           
            [['hour_duration'], 'required','on'=>'hour'],
            [['day_duration'], 'required','on'=>'day']
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'network'   => 'Select Network',
            'service'   => 'Select Service',
            'tag'       => 'Select Tag',
            'utilization' => 'Select Utilization',
            'duration' => 'Select Duration',
            'hour_duration' => 'Select Hour',
            'day_duration'  => 'Select Day',
            'utilization_type' => 'Type Of Utilization',
            'a_end_host' => 'A End Hostname',
            'z_end_host' => 'Z End Hostname',
        ];
    }

    public static function getUtilization()
    {
        return ["peak" => "peak", "average" => "average", "95precentile" => "95 precentile"];
    }

    public static function getDuration()
    {
        return ["hour" => "hour", "day" => "day"];
    }

    public static function getHours()
    {
        $hours = range(1,24);
        return $hours;
    }

    public static function getDays()
    {
        $days = range(1,30);
        return $days;
    }

    public static function getUtilizationType()
    {
        return ["QOSclassbased" => "Class Based", "combined" => "Combined"];
    }
}
