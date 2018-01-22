<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rubric".
 *
 * @property int $id
 * @property string $title
 * @property int $parent_id
 */
class Rubric extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rubric';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id'], 'integer'],
            [['parent_id'], 'default', 'value' => 0],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Рубрики',
            'title' => 'Название',
            'parent_id' => 'Родительская рубрика',
        ];
    }

    /**
     * Связь книг
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['rubric_id'=>'id']);
    }

    /**
     * Связь рубрик для иерархии
     */
    public function getRubric()
    {
        return $this->hasOne(Rubric::className(),['id' => 'parent_id']);
    }
}
