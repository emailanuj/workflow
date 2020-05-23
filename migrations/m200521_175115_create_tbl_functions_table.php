<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%tbl_functions}}`.
 */
class m200521_175115_create_tbl_functions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_functions}}', [
            'id' => $this->primaryKey(),
            'function_name' => $this->string()->notNull(),
            'function_type' => $this->string(50)->notNull(),
            'tbl_functionscol' => $this->string(45)->notNull(),
            'function_url' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);

        $strCurrentDateTime = new Expression('NOW()');
        
        Yii::$app->db->createCommand()->batchInsert('tbl_functions', 
            ['function_name','function_type','tbl_functionscol','function_url','created_at','updated_at'], 
            [
                ['get_cur_data()','EXECUTABLE','col','url',$strCurrentDateTime, $strCurrentDateTime],
                ['get_nso_data()','EXECUTABLE','col','url', $strCurrentDateTime, $strCurrentDateTime]
            ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_functions}}');
    }
}
