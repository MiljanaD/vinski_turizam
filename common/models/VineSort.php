<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vine_sort".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 *
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
            [['name', 'imageFile'], 'required'],
            [['name'], 'unique', 'message' => 'This vine sort already exists!'],
            [['name', 'description'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['name', 'description', 'image'], 'safe']
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
            'image' => 'Slika',
            'imageFile' => 'Slika'
        ];
    }
}
