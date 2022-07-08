<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social_media".
 *
 * @property int $id
 * @property string $name
 *
 * @property WinerySocialMedia[] $winerySocialMedia
 */
class SocialMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[WinerySocialMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWinerySocialMedia()
    {
        return $this->hasMany(WinerySocialMedia::className(), ['social_media' => 'id']);
    }
}
