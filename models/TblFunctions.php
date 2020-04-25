<?php

namespace app\models;

use Yii;

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
}
