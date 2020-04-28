<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workflow_execution".
 *
 * @property int $id
 * @property int $instance_id
 * @property string $request_params
 * @property string $response_params
 * @property int $executed_at
 * @property int $executed_by
 * @property int $status
 */
class WorkflowExecution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workflow_execution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instance_id', 'request_params', 'response_params', 'executed_at', 'executed_by'], 'required'],
            [['instance_id', 'executed_at', 'executed_by', 'status'], 'integer'],
            [['request_params', 'response_params'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instance_id' => 'Instance ID',
            'request_params' => 'Request Params',
            'response_params' => 'Response Params',
            'executed_at' => 'Executed At',
            'executed_by' => 'Executed By',
            'status' => 'Status',
        ];
    }
}
