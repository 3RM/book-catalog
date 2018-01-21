<?php

use yii\db\Migration;

/**
 * Handles the creation of table `publishing_address`.
 */
class m180120_185518_create_publishing_address_table extends Migration
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

        $this->createTable('{{%publishing_address}}', [
            'id' => $this->primaryKey(),
            'publishing_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'street' => $this->string()->notNull(),
            'number' => $this->integer()->notNull(),

        ],$tableOptions);

        // creates index for column `city_id`
        $this->createIndex('idx-publishing_address-city_id', '{{%publishing_address}}', 'city_id');
        // creates index for column `publishing_id`
        $this->createIndex('idx-publishing_address-publishing_id', '{{%publishing_address}}', 'publishing_id');

        // add foreign key for table `publishing_id`
        $this->addForeignKey(
            'fk-publishing_address-publishing_id',
            'publishing_address',
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
        $this->dropTable('{{%publishing_address}}');
    }
}
