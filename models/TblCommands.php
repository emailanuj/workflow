<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_commands".
 *
 * @property int $id
 * @property string $command_name
 * @property int $is_deleted
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class TblCommands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_commands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'command_name', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['id', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['command_name'], 'string', 'max' => 255],
            [['created_by', 'updated_by'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'command_name' => 'Command Name',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
