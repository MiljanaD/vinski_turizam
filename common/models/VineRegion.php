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
    public $vineSort;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wine_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'GPS_coordinates', 'vineSort'], 'required'],
            [['name', 'GPS_coordinates'], 'string', 'max' => 255],
            [['name', 'GPS_coordinates', 'vineSort'], 'safe']
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
            'vineSort' => 'Vinske sorte'
        ];
    }
}
