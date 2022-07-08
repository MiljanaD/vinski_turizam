<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string|null $web_site
 * @property string|null $email
 * @property string|null $phone
 * @property int $winery
 *
 * @property Winery $winery0
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['winery'], 'required'],
            [['winery'], 'integer'],
            [['web_site', 'email', 'phone'], 'string', 'max' => 255],
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
            'web_site' => 'Web Site',
            'email' => 'Email',
            'phone' => 'Phone',
            'winery' => 'Winery',
        ];
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
