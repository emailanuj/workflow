<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "workflow".
 *
 * @property int $id
 * @property string|null $workflow_title
 * @property string|null $workflow_description
 * @property string|null $workflow_data
 * @property string|null $workflow_json
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $deleted
 *
 * @property WorkflowExecution[] $workflowExecutions
 */
class Workflow extends ActiveRecord
{
    public $execution_status;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workflow';
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
            [['workflow_title'], 'required'],
            [['workflow_title'], 'string', 'max' => 100],
            [['workflow_description'], 'string', 'max' => 200],
            [['workflow_data', 'workflow_json'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workflow_title' => 'Workflow Title',
            'workflow_description' => 'Workflow Description',
            'workflow_data' => 'Workflow Data',
            'workflow_json' => 'Workflow Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * Gets query for [[WorkflowExecutions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkflowExecutions()
    {
        return $this->hasMany(WorkflowExecution::className(), ['instance_id' => 'id']);
    }
}
