<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book_author`.
 */
class m180121_121123_create_book_author_table extends Migration
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

        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `book_id`
        $this->createIndex('idx-book_author-book_id', '{{%book_author}}', 'book_id');
        // creates index for column `author_id`
        $this->createIndex('idx-book_author-author_id', '{{%book_author}}', 'author_id');

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-book_author-book_id',
            'book_author',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        // add foreign key for table `author`
        $this->addForeignKey(
            'fk-book_author-author_id',
            'book_author',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%book_author}}');
    }
}
