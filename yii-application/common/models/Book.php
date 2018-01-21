<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $photo_id
 * @property int $rubric_id
 * @property string $date_publishing
 *
 * @property BookAuthor[] $bookAuthors
 * @property Image[] $images
 */
class Book extends \yii\db\ActiveRecord
{

    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['date_publishing'], 'date', 'format'=>'php:Y-m-d'],
            [['date_publishing'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'photo_id' => 'Photo ID',
            'rubric_id' => 'Rubric ID',
            'date_publishing' => 'Date Publishing',
        ];
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Photo::className(), ['book_id' => 'id']);
    }

    public function getImagesSrc()
    {
        return $this->getImages()->select('src')->asArray()->all();
    }

    /**
    * @return 
    */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    public function saveImage($filename){
        $image = new Photo();
        $image->book_id = $this->id;
        $image->src = $filename;

        return $image->save(false);
    }
}
