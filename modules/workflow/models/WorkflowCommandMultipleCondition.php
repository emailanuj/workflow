<?php

namespace app\modules\workflow\models;

use Yii;
use yii\base\Model;

class WorkflowCommandMultipleCondition extends Model
{
    public $application_os;
    public $select_command;
    public $condition;
    public $operator;
    public $input_val;
    public $logic;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['condition', 'operator','input_val','logic'], 'required'],
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
            'condition' => 'Condition',
            'operator' => 'Operator',
            'input_val' => 'Input Value',
            'logic' => 'Add Logic'
        ];
    }
}
