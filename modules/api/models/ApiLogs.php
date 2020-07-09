<?php

namespace app\modules\api\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "api_logs".
 *
 * @property int $id
 * @property string $app_type
 * @property string $request
 * @property string $response
 * @property int $status
 * @property int $is_deleted
 * @property int $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class ApiLogs extends \yii\db\ActiveRecord
{
    const ORCHESTRATOR = 'ORCHESTRATOR';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_logs';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
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
            [['app_type', 'request', 'response', 'status', 'created_at'], 'required'],
            [['request', 'response'], 'string'],
            [['status', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['app_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_type' => 'App Type',
            'request' => 'Request',
            'response' => 'Response',
            'status' => 'Status',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function saveApiLogs(){
        
    }


}
