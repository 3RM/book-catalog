<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "publishing".
 *
 * @property int $id
 * @property string $title
 * @property int $book_id
 * @property int $address_id
 * @property int $phone_id
 *
 * @property PublishingAddress[] $publishingAddresses
 * @property PublishingPhone[] $publishingPhones
 */
class Publishing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publishing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title',], 'required'],
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

        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['publishing_id' => 'id']);
    }

    public function getBooksList()
    {
        return implode(", ", ArrayHelper::map($this->books, "id", "title"));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishingAddresses()
    {
        return $this->hasOne(PublishingAddress::className(), ['publishing_id' => 'id']);
    }

    public function clearAddress($id)
    {
        PublishingAddress::deleteAll(['publishing_id' => $this->id]);
    }


    public function getAddress()
    {
        if(isset($this->publishingAddresses)){
            return $this->publishingAddresses->street. " №". $this->publishingAddresses->number;
        }else{
            return "Адреса пока нет";
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(PublishingPhone::className(), ['publishing_id' => 'id']);
    }

    public function getPhonesNumberList()
    {
        return implode(", ", ArrayHelper::map($this->phones, "id", "phone"));
    }
}
