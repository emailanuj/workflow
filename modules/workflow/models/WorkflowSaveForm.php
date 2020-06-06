<?php

namespace app\modules\workflow\models;

use Yii;

/**
 * This is the model class for collection "MongoWorkflow".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $session_id
 * @property mixed $workflow_title
 * @property mixed $workflow_description
 * @property mixed $workflow_data
 * @property mixed $workflow_json
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $created_by
 * @property mixed $updated_by
 * @property mixed $saved_in_db
 * @property mixed $id_in_db
 */
class MongoWorkflow extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['cisco_workflow', 'MongoWorkflow'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'session_id',
            'workflow_title',
            'workflow_description',
            'workflow_data',
            'workflow_json',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'saved_in_db',
            'id_in_db',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'workflow_title', 'workflow_description', 'workflow_data', 'workflow_json', 'created_at', 'updated_at', 'created_by', 'updated_by','saved_in_db','id_in_db'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'session_id' => 'Session ID',
            'workflow_title' => 'Workflow Title',
            'workflow_description' => 'Workflow Description',
            'workflow_data' => 'Workflow Data',
            'workflow_json' => 'Workflow Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'saved_in_db'=> 'Saved in DB',
            'id_in_db'   => 'Id in DB'
        ];
    }
}
