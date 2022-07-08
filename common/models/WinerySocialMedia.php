<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "winery_social_media".
 *
 * @property int $id
 * @property int $social_media
 * @property int $winery
 *
 * @property SocialMedia $socialMedia
 * @property Winery $winery0
 */
class WinerySocialMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'winery_social_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['social_media', 'winery'], 'required'],
            [['social_media', 'winery'], 'integer'],
            [['social_media'], 'exist', 'skipOnError' => true, 'targetClass' => SocialMedia::className(), 'targetAttribute' => ['social_media' => 'id']],
            [['winery'], 'exist', 'skipOnError' => true, 'targetClass' => Winery::className(), 'targetAttribute' => ['winery' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'social_media' => 'Social Media',
            'winery' => 'Winery',
        ];
    }

    /**
     * Gets query for [[SocialMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocialMedia()
    {
        return $this->hasOne(SocialMedia::className(), ['id' => 'social_media']);
    }

    /**
     * Gets query for [[Winery0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWinery0()
    {
        return $this->hasOne(Winery::className(), ['id' => 'winery']);
    }
}
