<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_functions".
 *
 * @property int $id
 * @property string|null $function_name
 * @property string|null $function_type
 * @property int|null $deleted
 */
class TblFunctions extends \yii\db\ActiveRecord
{
    const EXECUTABLE = 'EXECUTABLE';
    const GETDATA = 'GETDATA';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_functions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['function_type'], 'string'],
            [['deleted'], 'integer'],
            [['function_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'function_name' => 'Function Name',
            'function_type' => 'Function Type',
            'deleted' => 'Deleted',
        ];
    }

    public static function getAllExecutableFunction()
    {
        $arrTblFunctions = TblFunctions::find()->where(['function_type' => TblFunctions::EXECUTABLE ])->orderBy(['function_name'=>SORT_ASC])->all();
        return ArrayHelper::map($arrTblFunctions,'function_name','function_name');
    }
    public static function getAllDataFunction()
    {
        $arrTblFunctions = TblFunctions::find()->where(['function_type' => TblFunctions::GETDATA ])->orderBy(['function_name'=>SORT_ASC])->all();
        return ArrayHelper::map($arrTblFunctions,'function_name','function_name');
    }
}
