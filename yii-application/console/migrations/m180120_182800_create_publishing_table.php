<?php

use yii\db\Migration;

/**
 * Handles the creation of table `publishing`.
 */
class m180120_182800_create_publishing_table extends Migration
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

        $this->createTable('{{%publishing}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'address_id' => $this->integer()->notNull(),
        ], $tableOptions);

    // creates index for column `address_id`
        $this->createIndex('idx-publishing-address_id', '{{%publishing}}', 'address_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%publishing}}');
    }
}
