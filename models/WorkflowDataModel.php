<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "workflow".
 *
 * @property int $step_no
 * @property string|null $if_fail
 * @property string|null $next_process
 */


class WorkflowDataModel extends Model
{

    public $selectedId;
    public $if_fail;
    public $next_process;

    
    // public $abc;
    // public $def;
    // public $ghi;



    // public $jkl;
    // public $mnp;
    // public $pqr;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['step_no','if_fail'], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'step_no' => 'Step No',
            'if_fail' => 'If Fail',
            'next_process' => 'Next Process'
        ];
    }
    
}
