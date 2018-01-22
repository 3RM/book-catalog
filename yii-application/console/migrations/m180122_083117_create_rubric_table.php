<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rubric`.
 */
class m180122_083117_create_rubric_table extends Migration
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

        $this->createTable('{{%rubric}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),            
        ], $tableOptions);

        // creates index for column `parent_id`
        $this->createIndex('idx-rubric-parent_id', '{{%rubric}}', 'parent_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%rubric}}');
    }
}
