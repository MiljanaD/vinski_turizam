<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $phone_number
 * @property int $street_number
 * @property int $role
 * @property int $street
 * @property bool $status
 * @property string $verification_token
 *
 * @property Roles $role0
 * @property Street $street0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'password', 'phone_number', 'street_number', 'street'], 'required'],
            [['street_number', 'role', 'street'], 'integer'],
            [['name', 'surname', 'email', 'password', 'phone_number'], 'string', 'max' => 255],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role' => 'id']],
            [['street'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street' => 'id']],
            [['name', 'surname', 'email', 'password', 'phone_number', 'street_number', 'role', 'street','status', 'verification_token'],'safe']
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
            'surname' => 'Surname',
            'email' => 'Email',
            'password' => 'Password',
            'phone_number' => 'Phone Number',
            'street_number' => 'Street Number',
            'role' => 'Role',
            'street' => 'Street',
        ];
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token =  Yii::$app->getSecurity()->generateRandomString();
        var_dump($this->verification_token);
    }

    public function findByVerificationToken($token)
    {
        return User::find()->where(['verification_token' => $token])->one();
    }

    /**
     * Gets query for [[Role0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role']);
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

    public static function findByEmail($email)
    {
        return User::find()->where(['email' => $email])->one();
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
