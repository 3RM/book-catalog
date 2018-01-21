<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo`.
 */
class m180121_130555_create_photo_table extends Migration
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

        $this->createTable('{{%photo}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'src' => $this->string()->notNull()
        ], $tableOptions);

        // creates index for column `book_id`
        $this->createIndex('idx-photo-book_id', '{{%photo}}', 'book_id');

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-photo-book_id',
            'photo',
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
        $this->dropTable('{{%photo}}');
    }
}
