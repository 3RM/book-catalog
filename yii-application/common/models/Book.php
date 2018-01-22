<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $rubric_id
 * @property string $date_publishing
 *
 * @property BookAuthor[] $bookAuthors
 * @property Image[] $images
 */
class Book extends \yii\db\ActiveRecord
{

    public $image;
    public $author_list;
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
            [['publishing_id', 'rubric_id'], 'integer'],
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
            'id' => '№ Книги',
            'title' => 'Название',
            'rubric_id' => 'Рубрика',
            'publishing_id' => 'Издание',
            'date_publishing' => 'Дата публикации',
        ];
    }

    /**
     * Связь по рубрикам
    */
    public function getRubric()
    {
        return $this->hasOne(Rubric::className(),['id'=>'rubric_id']);
    }

    /**
     * Связь по издательствам
    */
    public function getPublishing()
    {
        return $this->hasOne(Publishing::className(), ['id' => 'publishing_id']);
    }

    /**
     * Выборка текущего издательства для dropDown
    */
    public function getSelectedPublishing()
    {
        $selectedPublishing = $this->getPublishing()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedPublishing, 'id');

    }

    /**
     * Сохранение издательства в модели book
    */
    public function savePublishing($publishing_id)
    {           
        $this->publishing_id = $publishing_id;
        $this->save();

    }

    /**
     * Связь по авторам
    */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

    /**
     * Выборка текущих авторов книги
    */
    public function getSelectedAuthors()
    {
        $selectedAuthors = $this->getAuthors()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedAuthors, 'id');

    }

    /**
     * Удаление текущих авторов книги
    */
    public function clearCurrentAuthors()
    {
        BookAuthor::deleteAll(['book_id' => $this->id]);
    }

    /**
     * Список существующих авторов
    */
    public function getAuthorsList()
    {
        return implode(", ", ArrayHelper::map($this->authors, "id", "title"));
    }

    /**
     * Привязка автора(ов) к модели book
    */
    public function saveAuthors($authors)
    {
        if(is_array($authors))
        {
            $this->clearCurrentAuthors();

            foreach($authors as $author_id)
            {
                $author = Author::findOne($author_id);
                $this->link('authors', $author);
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Photo::className(), ['book_id' => 'id']);
    }

    /**
     * Выборка имен картинок
    */
    public function getImagesSrc()
    {
        return $this->getImages()->select('src')->asArray()->all();
    }

    /**
     * Выборка первой картинки книги.
     * Она тем самым будет являться главное и выводиться в вид
    */
    public function getMainImage()
    {
        return $this->getImages()->select('src')->one();
    }

    /**
    * Форматирование даты
    */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }
    /**
     * Сохранение изображения в БД
     */
    public function saveImage($filename){
        $image = new Photo();
        $image->book_id = $this->id;
        $image->src = $filename;

        return $image->save(false);
    }

    /**
     * Массив с изображениями для виджета Carousel
     */
    public function getGalleryUrls($id)
    {
        foreach($this->imagesSrc as $image)
        {
            $images[] = [
                    'content' => "<img src='".'/uploads/'.$image['src']."' class='slider-img'/>",
            ];
        }

        return $images;
    }

}
