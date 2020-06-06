<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_service_threshold}}`.
 */
class m200606_085219_create_tbl_service_threshold_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_service_threshold}}', [
            'id' => $this->primaryKey(),
            'service_type' => $this->string()->notNull(),
            'tags' => $this->string(100)->notNull(),
            'threshold_for_peak_in_last_15days' => $this->integer()->notNull(),
            'threshold_for_current_utilisation' => $this->integer()->notNull(),
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
        $this->dropTable('{{%tbl_service_threshold}}');
    }
}
