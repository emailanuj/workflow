<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "workflow".
 *
 * @property int $clone_type
 * @property string|null $clone_id
 */


class WorkflowClone extends Model
{

    public $clone_type;
    public $clone_id;    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clone_type','clone_id'], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clone_type' => 'Clone Type',
            'clone_id' => 'Clone Id',
        ];
    }
    
}
