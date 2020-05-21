<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%tbl_workflow}}`.
 */
class m200521_175149_create_tbl_workflow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_workflow}}', [
            'id' => $this->primaryKey(),
            'workflow_title' => $this->string(100)->notNull(),
            'workflow_description' => $this->string(200),
            'workflow_data' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'workflow_json' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);

        Yii::$app->db->createCommand()->batchInsert('tbl_workflow', 
            ['workflow_title','workflow_description','workflow_data','workflow_json','created_at'], 
            [
                ['Workflow-3','Workflow with multiple elements',
                '{"SEstartEvnet2":{"step_no":"2","if_fail":"stop","next_process":"3","keywords":"NSO","api_url":"","api_method":"","api_type":"","api_headers":"","function_execute":"","auth_type":"","token_from":"","token_url":"","username":"","password":"","data_source":"function_name","get_data_function":"workflow-execution\/functionex","form_data":"test22"},"SEstartEvnet1":{"step_no":"1","if_fail":"continue","next_process":"2","keywords":"API","api_url":"http:\/\/localhost\/bpnm-api\/getapi.php","api_method":"get","api_type":"rest","api_headers":"no","function_execute":"get_cur_data()","auth_type":"token","token_from":"prev_response","token_url":"","username":"","password":"","data_source":"","get_data_function":"","form_data":""},"SEstartEvnet3":{"step_no":"3","if_fail":"continue","next_process":"4","keywords":"NSO","api_url":"","api_method":"","api_type":"","api_headers":"","function_execute":"","auth_type":"","token_from":"","token_url":"","username":"","password":"","data_source":"form_data","get_data_function":"","form_data":"test3"},"SEstartEvnet4":{"step_no":"4","if_fail":"stop","next_process":"0","keywords":"API","api_url":"http:\/\/localhost\/bpnm-api\/postapi.php","api_method":"post","api_type":"rest","api_headers":"no","function_execute":"get_cur_data()","auth_type":"token","token_from":"prev_response","token_url":"","username":"","password":"","data_source":"","get_data_function":"","form_data":""}}',
                '{"bpmn":[{"id":"startEvnet1","x":245,"y":183,"width":20,"height":20,"type":"startEvnet","subtype":"StartEvent","status":"1"},{"id":"startEvnet2","x":416.0104064941406,"y":184.0104217529297,"width":20,"height":20,"type":"startEvnet","subtype":"StartEvent","status":"1"},{"id":"startEvnet3","x":590,"y":187,"width":20,"height":20,"type":"startEvnet","subtype":"StartEvent","status":"1"},{"id":"startEvnet4","x":735,"y":186,"width":20,"height":20,"type":"startEvnet","subtype":"StartEvent","status":"1"},{"id":0,"type":"flow","start_x":265.0000116825104,"start_y":183.00000533527782,"end_x":386.01042294022045,"end_y":184.01042544096708,"mid_x":325.5052173113654,"start_id":"startEvnet1","end_id":"startEvnet2","start_type":"startEvent","end_type":"endEvent"},{"id":"flow2","type":"flow","start_x":436.01042294022045,"start_y":184.01042544096708,"end_x":560.0000281333923,"end_y":187.00001230769703,"mid_x":498.0052255368064,"start_id":"startEvnet2","end_id":"startEvnet3","start_type":"startEvent","end_type":"endEvent"},{"id":0,"type":"flow","start_x":610.0000281333923,"start_y":187.00001230769703,"end_x":705.0000350475311,"end_y":186.0000020874868,"mid_x":657.5000315904617,"start_id":"startEvnet3","end_id":"startEvnet4","start_type":"startEvent","end_type":"endEvent"},{"id":0,"type":"flow","start_x":265.0000116825104,"start_y":183.00000533527782,"end_x":386.01042294022045,"end_y":184.01042544096708,"mid_x":325.5052173113654,"start_id":"startEvnet1","end_id":"startEvnet2","start_type":"startEvent","end_type":"endEvent"},{"id":"flow1","type":"flow","start_x":265.0000116825104,"start_y":183.00000533527782,"end_x":386.01042294022045,"end_y":184.01042544096708,"mid_x":325.5052173113654,"start_id":"startEvnet1","end_id":"startEvnet2","start_type":"startEvent","end_type":"endEvent"},{"id":"flow2","type":"flow","start_x":610.0000281333923,"start_y":187.00001230769703,"end_x":710.0000350475311,"end_y":186.0000020874868,"mid_x":660.0000315904617,"start_id":"startEvnet3","end_id":"startEvnet4","start_type":"startEvent","end_type":"endEvent"}]}',new Expression('NOW()')
            ],
            ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_workflow}}');
    }
}
