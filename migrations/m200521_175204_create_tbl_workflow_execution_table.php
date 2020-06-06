<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%tbl_workflow_execution}}`.
 */
class m200521_175204_create_tbl_workflow_execution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%tbl_workflow_execution}}', [
            'id' => $this->primaryKey(),
            'instance_id' => $this->integer()->notNull(),
            'execution_id' => $this->string(100),
            'request_params' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'next_step' => $this->integer(),
            'response_params' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'api_domain' => $this->string(),
            'auth_token' => $this->string(),
            'workflow_diagram' => $this->text(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'executed_by' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);

        $this->createIndex(
            '{{%idx-tbl_workflow_execution-instance_id}}',
            '{{%tbl_workflow_execution}}',
            'instance_id'
        );

        $this->addForeignKey(
                            '{{%fk-tbl_workflow_execution-instance_id}}',
                            '{{%tbl_workflow_execution}}',
                            'instance_id',
                            '{{%tbl_workflow}}',
                            'id',
                            'CASCADE'
                        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropForeignKey(
            '{{%fk-tbl_workflow_execution-instance_id}}',
            '{{%tbl_workflow_execution}}'
        );

        // drops index for column `tbl_workflow_execution`
        $this->dropIndex(
            '{{%idx-tbl_workflow_execution-instance_id}}',
            '{{%tbl_workflow_execution}}'
        );
        
        $this->dropTable('{{%tbl_workflow_execution}}');
    }
}
