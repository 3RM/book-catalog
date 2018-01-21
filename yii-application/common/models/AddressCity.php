<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "address_city".
 *
 * @property int $id
 * @property int $address_id
 * @property string $title
 *
 * @property PublishingAddress $address
 */
class AddressCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id', 'title'], 'required'],
            [['address_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublishingAddress::className(), 'targetAttribute' => ['address_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_id' => 'Address ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(PublishingAddress::className(), ['id' => 'address_id']);
    }
}
