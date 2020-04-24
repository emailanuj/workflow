<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_keywords".
 *
 * @property int $id
 * @property string $keyword_name
 * @property int $is_deleted
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class TblKeywords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_keywords';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'keyword_name', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['id', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['keyword_name'], 'string', 'max' => 255],
            [['created_by', 'updated_by'], 'string', 'max' => 11],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword_name' => 'Keyword Name',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
