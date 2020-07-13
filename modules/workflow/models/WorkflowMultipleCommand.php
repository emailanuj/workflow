<?php

namespace app\modules\workflow\models;

use Yii;
use yii\base\Model;

class WorkflowMultipleCommand extends Model
{
    // public $application_os;
    public $select_command;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['select_command'], 'required'],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'select_command' => 'Select Command'
        ];
    }
}
