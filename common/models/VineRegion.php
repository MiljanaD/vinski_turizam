<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vine_region".
 *
 * @property int $id
 * @property string $name
 * @property string $GPS_coordinates
 */
class VineRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vine_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'GPS_coordinates'], 'required'],
            [['name', 'GPS_coordinates'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime regiona',
            'GPS_coordinates' => 'Gps Koordinate',
        ];
    }
}
