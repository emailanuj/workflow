<?php

namespace app\modules\workflow\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "workflow".
 *
 * @property string|null $clone_title
 * @property string|null $clone_description
 * @property int $clone_type
 * @property string|null $clone_id
 */


class WorkflowClone extends Model
{

    public $clone_title;
    public $clone_description;
    public $clone_type;
    public $clone_id;    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clone_title','clone_description','clone_type','clone_id'], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clone_title' => 'Clone Title',
            'clone_description' => 'Clone Description',
            'clone_type' => 'Clone Type',
            'clone_id' => 'Clone Id',
        ];
    }
    
}
