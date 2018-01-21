<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publishing_phone".
 *
 * @property int $id
 * @property int $publishing_id
 * @property string $phone
 *
 * @property Publishing $publishing
 */
class PublishingPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publishing_phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publishing_id', 'phone'], 'required'],
            [['publishing_id'], 'integer'],
            [['phone'], 'string', 'max' => 255],
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
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishing()
    {
        return $this->hasOne(Publishing::className(), ['id' => 'publishing_id']);
    }
}
