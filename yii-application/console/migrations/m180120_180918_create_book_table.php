<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m180120_180918_create_book_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName === 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),            
            'rubric_id' => $this->integer(),
            'date_publishing'=>$this->date()->notNull(),
        ], $tableOptions);
        
        // creates index for column `rubric_id`
        $this->createIndex('idx-book-rubric_id', '{{%book}}', 'rubric_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
