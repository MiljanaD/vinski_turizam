<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $phone_number
 * @property int $street_number
 * @property int $role
 * @property int $street
 * @property bool $activated
 *
 * @property Roles $role0
 * @property Street $street0
*/
class UserSearchModel extends User
{
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'password', 'phone_number', 'street_number', 'street'], 'required'],
            [['street_number', 'role', 'street'], 'integer'],
            [['name', 'surname', 'email', 'password', 'phone_number'], 'string', 'max' => 255],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role' => 'id']],
            [['street'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street' => 'id']],
            [['name', 'surname', 'email', 'password', 'phone_number', 'street_number', 'role', 'street','activated'],'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $this->load($params);

        $query = User::find();

        return new ActiveDataProvider([
            'query' => $query
        ]);

    }


}