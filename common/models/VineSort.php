<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vine_sort".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $vine_region
 * @property string|null $image
 *
 * @property VineRegion $vineRegion
 */
class VineSort extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vine_sort';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'vine_region', 'imageFile'], 'required'],
            [['name'], 'unique', 'message' => 'This vine sort already exists!'],
            [['vine_region'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['vine_region'], 'exist', 'skipOnError' => true, 'targetClass' => VineRegion::className(), 'targetAttribute' => ['vine_region' => 'id']],
            [['name', 'vine_region', 'description', 'image'], 'safe']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->image = $this->name . '.' . $this->imageFile->extension;
            $this->save();
            $this->imageFile->saveAs(dirname(dirname(__DIR__)) . '/frontend/web/images/vine-sort-images/' . $this->name . '.' . $this->imageFile->extension);
            return true;
        }
        return false;

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime vinske sorte',
            'description' => 'Kratak opis',
            'vine_region' => 'Vinski region',
            'image' => 'Slika',
            'imageFile' => 'Slika'
        ];
    }

    /**
     * Gets query for [[VineRegion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVineRegion()
    {
        return $this->hasOne(VineRegion::className(), ['id' => 'vine_region']);
    }
}
