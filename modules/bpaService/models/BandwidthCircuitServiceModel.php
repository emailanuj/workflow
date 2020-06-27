<?php

namespace app\modules\bpaService\models;

use Yii;
use yii\base\Model;
use yii\validators\EachValidator;

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
    public $z_end_host = [];    


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a_end_host', 'z_end_host'], 'each', 'rule' => ['required']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'a_end_host' => 'A End Hostname',            
            'z_end_host' => 'Z End Hostname',            
        ];
    }

}
