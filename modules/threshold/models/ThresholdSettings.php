<?php

namespace app\modules\threshold\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "threshold_settings".
 *
 * @property integer $id
 * @property string $threshold_name
 * @property string $network_type
 * @property string $service_type
 * @property integer $tag
 * @property string $utilization_type
 * @property string $threshold_condition
 * @property string $value
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class ThresholdSettings extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'threshold_settings';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'tag'], 'integer'],            
            [['threshold_name', 'threshold_condition', 'value'], 'required'],
            [['threshold_name', 'network_type', 'service_type', 'utilization_type', 'threshold_condition'], 'string', 'max' => 200],
            [['value'], 'string', 'max' => 250],
            [['network_type','service_type','tag','utilization_type'], 'required', 'on' => 'BPA'],
        ];
    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'threshold_name' => 'Threshold Name',
            'network_type'  => 'Network Type',
            'service_type'  => 'Service Type',
            'tag'  => 'Tag',
            'utilization_type'  => 'Utilization Type',
            'threshold_condition' => 'Condition',
            'value' => 'Value',
            'is_deleted' => 'Is Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function ThresholdList()
    {
        return array(
            'CCSM',
            'BPA',
            'SRA',
        );
    }
    

    public static function networkList()
    {
        return array(
            'IPMPLS' => 'IPMPLS',
            'CEN' => 'CEN',
            'ISP' =>'ISP',
        );
    }

    public static function serviceList()
    {
        return array(
            'L2VPN' => 'L2VPN',
            'L3VPN' => 'L3VPN',
            'ISP' => 'ISP',
        );
    }

    public static function tags()
    {
        return array(
            '1' => 'NNI',
            '2' => 'Expressway',
            '3' => 'Backbone',
            '4' => 'Backbone B2B',
            '5' => 'Access Links',
            '6' => 'Access Links B2B',
            '7' => 'Internet Links IBR to IBR',
            '8' => 'IBR to IGW',
        );
    }

    public static function utilizationList()
    {
        return array(
            'peak' => 'Peak',
            'average' => 'Average',
            '95precentile' => '95 Precentile',
            'actual'    => 'Actual'
        );
    }

    public static function thresholdConditions()
    {
        $condition = array(
            'less_than' => 'Less Than',
            'greater_than' => 'Greater Than',
            'less_than_equal' => 'Less Than Equal to',
            'greater_than_equal' => 'Greater Than Equal to',
            // 'between' => 'Between',
            // 'custom' => 'Custom'
        );

        //$final_result = array_combine($condition, $condition);
        return $condition;
    }

    public static function thresholdStatus()
    {
        $status = array(
            1 => 'Active',
            0 => 'Inactive'
        );

        return $status;
    }

    public static function getAllThresholdSetting($strNetwork, $strService, $strUtilization)
    {
        if(!empty($strNetwork) && !empty($strService) && !empty($strUtilization)) {
            $arrLists = self::find()->select(['threshold_name', 'threshold_condition', 'value'])->where(['is_deleted' => 0, 'network_type' => $strNetwork, 'service_type' => $strService, 'utilization_type' => $strUtilization])->AsArray()->all();
        } else {
            $arrLists = self::find()->select(['threshold_name', 'threshold_condition', 'value'])->where(['is_deleted' => 0])->AsArray()->all();
        }
        $arrSettingData = [];
        foreach ($arrLists as $key => $arrList) {
            $arrSettingData[$arrList['threshold_name']] = $arrList;
        }
        return $arrSettingData;
    }


    public static function selectConditionOperator($arrSetting, $intThresholdValue)
    {
        $strCondition = !empty($arrSetting['threshold_condition']) ? $arrSetting['threshold_condition'] : '';
        $intSetting = !empty($arrSetting['value']) ? $arrSetting['value'] : 0;
        $arrOutput = [];
        $arrOutput['status'] = 'failed';
        $arrOutput['message'] = '';


        if ($strCondition == 'less_than') {
            if ($intThresholdValue < $intSetting) {
                $arrOutput['status'] = 'success';
                $arrOutput['message'] = 'not more than ' . $intSetting . '%';
            } else {
                $arrOutput['message'] = 'more than ' . $intSetting . '%';
            }
        } elseif ($strCondition == 'less_than_equal') {
            if ($intThresholdValue <= $intSetting) {
                $arrOutput['status'] = 'success';
                $arrOutput['message'] = 'not more than ' . $intSetting . '%';
            } else {
                $arrOutput['message'] = 'more than ' . $intSetting . '%';
            }
        } elseif ($strCondition == 'greater_than') {
            if ($intThresholdValue > $intSetting) {
                $arrOutput['status'] = 'success';
            } else {
                $arrOutput['message'] = '';
            }
        } elseif ($strCondition == 'greater_than_equal') {
            if ($intThresholdValue >= $intSetting) {
                $arrOutput['status'] = 'success';
            } else {
                $arrOutput['message'] = '';
            }
        }

        // echo '<pre>';
        // print_r($arrOutput);
        // die;
        return $arrOutput;
    }

    public static function boolCheckThresholdPercentage($strModuleName, $strNetwork, $strService, $strUtilization, $intThresholdValue)
    {
        $objThresholdSettings = ThresholdSettings::getAllThresholdSetting($strNetwork, $strService, $strUtilization);
        //pe($objThresholdSettings);
        $arrSetting['threshold_condition'] = $objThresholdSettings[$strModuleName]['threshold_condition'];
        $arrSetting['value']               = $objThresholdSettings[$strModuleName]['value'];        
        $objCurrentThresholdValue = ThresholdSettings::selectConditionOperator($arrSetting, $intThresholdValue);
        return $objCurrentThresholdValue;
    }
}
