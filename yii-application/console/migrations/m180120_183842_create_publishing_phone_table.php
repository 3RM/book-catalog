<?php

use yii\db\Migration;

/**
 * Handles the creation of table `publishing_phone`.
 */
class m180120_183842_create_publishing_phone_table extends Migration
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

        $this->createTable('{{%publishing_phone}}', [
            'id' => $this->primaryKey(),
            'publishing_id' => $this->integer()->notNull(),
            'phone' => $this->string()->notNull(),
        ], $tableOptions);

    // creates index for column `publishing_id`
        $this->createIndex('idx-publishing_phone-publishing_id', '{{%publishing_phone}}', 'publishing_id');

    // add foreign key for table `publishing_id`
        $this->addForeignKey(
            'fk-publishing-publishing_id',
            'publishing_phone',
            'publishing_id',
            'publishing',
            'id',
            'CASCADE'
        );
    }    

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%publishing_phone}}');
    }
}
