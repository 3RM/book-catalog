<?php

use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m180120_182116_create_author_table extends Migration
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

        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),                 
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%author}}');
    }
}
