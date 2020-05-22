<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
// use yii\db\Expression;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "workflow_execution".
 *
 * @property int $id
 * @property int $instance_id
 * @property string $request_params
 * @property string $response_params
 * @property string $execution_id
 * @property string $api_domain
 * @property string|null $auth_token
 * @property int $created_at
 * @property int $updated_at
 * @property int $executed_by
 * @property int $status
 *
 * @property Workflow $instance
 */
class WorkflowExecution extends ActiveRecord
{
    public $workflow_title;
    public $workflow_description;
    public $executed_details;

    const NOT_STARTED = 0;
    const IN_PROGRESS = 1;
    const PASS = 2;
    const FAIL = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_workflow_execution';
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
                // 'value' => new Expression('NOW()')
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
            // [['instance_id', 'request_params', 'response_params', 'execution_id', 'api_domain', 'created_at', 'updated_at', 'executed_by'], 'required'],
            [['instance_id', 'created_at', 'updated_at', 'executed_by', 'status'], 'integer'],
            [['request_params', 'response_params'], 'string'],
            // [['execution_id'], 'string', 'max' => 20],
            [['api_domain', 'auth_token'], 'string', 'max' => 100],
            [['instance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workflow::className(), 'targetAttribute' => ['instance_id' => 'id']],
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
            'execution_id' => 'Execution ID',
            'api_domain' => 'Api Domain',
            'auth_token' => 'Auth Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'executed_by' => 'Executed By',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Instance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkflow()
    {
        return $this->hasOne(Workflow::className(), ['id' => 'instance_id']);
    }

     public function functionex() {
        return $data = 'I am the data returned by function call';        
    }
}
