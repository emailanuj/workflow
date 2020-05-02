<?php

// use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m200428_150504_create_news_table extends Migration
{


    public function up()
    {
        // $this->createTable('news', [
        //     'id' => $this->primaryKey(),
        //     'title' => $this->string()->notNull(),
        //     'content' => $this->text(),
        // ]);
    }

    public function down()
    {
        // echo "m101129_185401_create_news_table cannot be reverted.\n";
        // return false;
        // $this->dropTable('news');
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    //     $this->createTable('{{%news}}', [
    //         'id' => $this->primaryKey(),
    //     ]);
        $this->addColumn('news', 'category', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    //     $this->dropTable('{{%news}}');
    }
}
