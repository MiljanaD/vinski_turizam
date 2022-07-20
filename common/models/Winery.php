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
 * @property int $city
 * @property int $municipality
 */
class Winery extends \yii\db\ActiveRecord
{
    public $city;
    public $municipality;
    public $contact;
    public $contactInfo;
    public $images;
    public $services;

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
            [['name', 'GPS_coordinates', 'owner','services'], 'required'],
            [['street', 'owner'], 'integer'],
            [['name', 'GPS_coordinates', 'description'], 'string', 'max' => 255],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['owner' => 'id']],
            [['street'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street' => 'id']],
            [['name', 'images', 'GPS_coordinates', 'owner','street','contact', 'contactInfo', 'services'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime',
            'street' => 'Ulica',
            'municipality' => 'Opstina',
            'city' => 'Grad',
            'GPS_coordinates' => 'Gps koordinate',
            'description' => 'Opis',
            'owner' => 'Vlasnik',
            'contact' => 'Vrsta kontakta',
            'services' => 'Usluge vinarije'
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $this->save();
            $this->refresh();
            $contact = new Contact();
            $contact->winery = $this->id;
            switch ($this->contact) {
                case 'email':
                    $contact->email = $this->contactInfo;
                    break;
                case 'web_site':
                    $contact->web_site = $this->contactInfo;
                    break;
                case 'phone':
                    $contact->phone = $this->contactInfo;
                    break;
                case 'social_media':
                    $contact->social_media = $this->contactInfo;
                    break;
            }

            $contact->save();
            foreach ($this->images as $image)
            {
                $modelImage = new Image();
                $modelImage->name = $image->name;
                $modelImage->winary = $this->id;
                $modelImage->save();
                $image->saveAs(dirname(dirname(__DIR__)) . '/frontend/web/images/winery-images/' . $image->name);
            }
            return true;
        }
        return false;

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
