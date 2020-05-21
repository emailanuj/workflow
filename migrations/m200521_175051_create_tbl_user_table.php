<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_user}}`.
 */
class m200521_175051_create_tbl_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull()->unique(),
            'password' => $this->string(100)->notNull(),
            'auth_key' => $this->string(100)->notNull(),
            'access_token' => $this->string(100)->notNull(),
        ]);

         Yii::$app->db->createCommand()->batchInsert('tbl_user', 
            ['username','password','auth_key','access_token'], 
            [
                ['anuj','$2y$13$aGwst9A4/fslv.bvrzm80./D/36VNTGsRwC5PoFXpWuc7rIyl03mW','nTrmGmxsQvyZoAJCMEh6LDx-8NhfK0Vh','KCYSJlVCbTCMy4HyhTSJcCdOR5I_Kcm9'],
            ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_user}}');
    }
}
