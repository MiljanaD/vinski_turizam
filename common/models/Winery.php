<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "winery".
 *
 * @property int $id
 * @property string $name
 * @property int|null $street
 * @property string $GPS_coordinates
 * @property string|null $description
 * @property int $owner
 *
 * @property Contact[] $contacts
 * @property Image[] $images
 * @property Owner $owner0
 * @property Street $street0
 * @property WinerySocialMedia[] $winerySocialMedia
 */
class Winery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'winery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'GPS_coordinates', 'owner'], 'required'],
            [['street', 'owner'], 'integer'],
            [['name', 'GPS_coordinates', 'description'], 'string', 'max' => 255],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['owner' => 'id']],
            [['street'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street' => 'id']],
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
            'street' => 'Street',
            'GPS_coordinates' => 'Gps Coordinates',
            'description' => 'Description',
            'owner' => 'Owner',
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['winery' => 'id']);
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['winary' => 'id']);
    }

    /**
     * Gets query for [[Owner0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(Owner::className(), ['id' => 'owner']);
    }

    /**
     * Gets query for [[Street0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStreet0()
    {
        return $this->hasOne(Street::className(), ['id' => 'street']);
    }

    /**
     * Gets query for [[WinerySocialMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWinerySocialMedia()
    {
        return $this->hasMany(WinerySocialMedia::className(), ['winery' => 'id']);
    }
}
