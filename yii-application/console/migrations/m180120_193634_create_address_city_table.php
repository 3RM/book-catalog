<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address_city`.
 */
class m180120_193634_create_address_city_table extends Migration
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

        $this->createTable('{{%address_city}}', [
            'id' => $this->primaryKey(),
            'address_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
        ], $tableOptions);

        // creates index for column `address_id`
        $this->createIndex('idx-address_city-address_id', '{{%address_city}}', 'address_id');

        // add foreign key for table `address_id`
        $this->addForeignKey(
            'fk-address_city-address_id',
            'address_city',
            'address_id',
            'publishing_address',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%address_city}}');
    }
}


