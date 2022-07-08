<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $name
 * @property int $winary
 *
 * @property Winery $winary0
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'winary'], 'required'],
            [['winary'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['winary'], 'exist', 'skipOnError' => true, 'targetClass' => Winery::className(), 'targetAttribute' => ['winary' => 'id']],
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
            'winary' => 'Winary',
        ];
    }

    /**
     * Gets query for [[Winary0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWinary0()
    {
        return $this->hasOne(Winery::className(), ['id' => 'winary']);
    }
}
