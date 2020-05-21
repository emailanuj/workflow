<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%tbl_keywords}}`.
 */
class m200521_175129_create_tbl_keywords_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_keywords}}', [
            'id' => $this->primaryKey(),
            'keyword_name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);

        $strCurrentDateTime = new Expression('NOW()');

        Yii::$app->db->createCommand()->batchInsert('tbl_keywords', 
            ['keyword_name','created_at','updated_at'], 
            [
                ['Precheck',$strCurrentDateTime, $strCurrentDateTime],
                ['Postcheck', $strCurrentDateTime, $strCurrentDateTime],
                ['NSO', $strCurrentDateTime, $strCurrentDateTime],
                ['API', $strCurrentDateTime, $strCurrentDateTime]
            ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_keywords}}');
    }
}
