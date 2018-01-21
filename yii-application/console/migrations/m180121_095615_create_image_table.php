<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m180121_095615_create_image_table extends Migration
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

        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'src' => $this->string()->notNull(),
            'alt' => $this->string(),
        ], $tableOptions);

        // creates index for column `book_id`
        $this->createIndex('idx-image-book_id', '{{%image}}', 'book_id');

        // add foreign key for table `book_id`
        $this->addForeignKey(
            'fk-image-book_id',
            'image',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%image}}');
    }
}
