<?php

namespace app\modules\threshold\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "service_threshold".
 *
 * @property int $id
 * @property string $service_type
 * @property string $tags
 * @property int $threshold_for_peak_in_last_15days
 * @property int $threshold_for_current_utilisation
 */
class ServiceThreshold extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_service_threshold';
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
            [['service_type', 'tags', 'threshold_for_peak_in_last_15days', 'threshold_for_current_utilisation'], 'required'],
            [['threshold_for_peak_in_last_15days', 'threshold_for_current_utilisation'], 'integer'],
            [['service_type'], 'string', 'max' => 50],
            [['tags'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_type' => 'Service Type',
            'tags' => 'Tags',
            'threshold_for_peak_in_last_15days' => 'Threshold For Peak In Last 15days',
            'threshold_for_current_utilisation' => 'Threshold For Current Utilisation',
        ];
    }
}
