<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 *
 * @property Municipality[] $municipalities
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
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
            'name' => 'Grad',
        ];
    }

    /**
     * Gets query for [[Municipalities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipalities()
    {
        return $this->hasMany(Municipality::className(), ['city_id' => 'id']);
    }
}
