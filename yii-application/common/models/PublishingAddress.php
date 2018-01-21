<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publishing_address".
 *
 * @property int $id
 * @property int $publishing_id
 * @property int $city_id
 * @property string $street
 * @property int $number
 *
 * @property AddressCity[] $addressCities
 * @property Publishing $publishing
 */
class PublishingAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publishing_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publishing_id', 'street', 'number'], 'required'],
            [['publishing_id', 'number'], 'integer'],
            [['street'], 'string', 'max' => 255],
            [['publishing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publishing::className(), 'targetAttribute' => ['publishing_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publishing_id' => 'Publishing ID',
            'street' => 'Street',
            'number' => 'Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressCities()
    {
        return $this->hasOne(AddressCity::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishing()
    {
        return $this->hasOne(Publishing::className(), ['id' => 'publishing_id']);
    }
}
