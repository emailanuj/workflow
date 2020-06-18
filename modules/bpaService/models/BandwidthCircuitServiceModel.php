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

class BandwidthCircuitServiceModel extends Model
{

    public $utilization;
    public $duration;
    public $utilization_type;
    public $a_end_host;
    public $a_end_ip;
    public $z_end_host;
    public $z_end_ip;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['utilization', 'duration', 'utilization_type', 'a_end_host', 'a_end_ip', 'z_end_host', 'z_end_ip'], 'required'],

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
            'utilization_type' => 'Type Of Utilization',
            'a_end_host' => 'Aend Hostname',
            'a_end_ip' => 'Aend IP',
            'z_end_host' => 'Zend Hostname',
            'z_end_ip' => 'Zend IP'
        ];
    }

    public static function getUtilization()
    {
        return ["peak" => "peak", "average" => "average", "95precentile" => "95 precentile"];
    }

    public static function getDuration()
    {
        return ["1h" => "1 HR", "1d" => "1 Day", "7d" => "7 Days"];
    }

    public static function getUtilizationType()
    {
        return ["QOSclassbased" => "Class Based", "combined" => "Combined"];
    }
}
