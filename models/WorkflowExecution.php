<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;


/**
 * This is the model class for table "workflow_execution".
 *
 * @property int $id
 * @property int $instance_id
 * @property string $request_params
 * @property string $response_params
 * @property int $created_at
 * @property int $updated_at
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

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instance_id', 'request_params', 'response_params'], 'required'],
            [['instance_id', 'created_at','updated_at', 'executed_by', 'status'], 'integer'],
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
            'created_at' => 'Executed At',
            'updated_at' => 'Executed At',
            'executed_by' => 'Executed By',
            'status' => 'Status',
        ];
    }

    public function functionex() {
        return $data = 'I am the data returned by function call';        
    }

    
}
