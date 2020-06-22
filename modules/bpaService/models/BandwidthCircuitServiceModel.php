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
    
    public $a_end_host = [];
    public $a_end_ip = [];
    public $z_end_host = [];
    public $z_end_ip = [];


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a_end_host', 'a_end_ip', 'z_end_host', 'z_end_ip'], 'each', 'rule' => ['required']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'a_end_host' => 'Aend Hostname',
            'a_end_ip' => 'Aend IP',
            'z_end_host' => 'Zend Hostname',
            'z_end_ip' => 'Zend IP'
        ];
    }

}
