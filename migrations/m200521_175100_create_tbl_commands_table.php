<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_commands}}`.
 */
class m200521_175100_create_tbl_commands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_commands}}', [
            'id' => $this->primaryKey(),
            'command_name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_commands}}');
    }
}
