<?php

namespace app\modules\bpaService\models;

use Yii;
use yii\base\Model;

class BandwidthCircuitServiceModel extends Model
{
    
    public $circuit_id;
    public $vpn_id;
    public $role_id;
    public $primary_interface;
    public $secondary_interface;
    public $qos_bandwidth;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['circuit_id', 'vpn_id', 'role_id', 'primary_interface', 'secondary_interface', 'qos_bandwidth'], 'required']

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'circuit_id' => 'Circuit Id',            
            'vpn_id' => 'VPN Id',
            'role_id' => 'Role Id',
            'primary_interface' => 'Primary Interface',
            'secondary_interface' => 'Secondary Interface',
            'qos_bandwidth' => 'Bandwidth',            
        ];
    }

}
