<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "street".
 *
 * @property int $id
 * @property string $name
 * @property int $municipality_id
 *
 * @property Municipality $municipality
 * @property User[] $users
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'street';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'municipality_id'], 'required'],
            [['municipality_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['municipality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['municipality_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ulica',
            'municipality_id' => 'Municipality ID',
        ];
    }

    /**
     * Gets query for [[Municipality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipality()
    {
        return $this->hasOne(Municipality::className(), ['id' => 'municipality_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['street' => 'id']);
    }
}
