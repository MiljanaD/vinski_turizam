<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
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
 * @property int $city
 * @property int $municipality
 * @property bool $status
 * @property string $password_reset_token
 * @property string $verification_token
 * @property bool $activated
 *
 * @property Roles $role0
 * @property Street $street0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $city;
    public $municipality;
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
            'name' => 'Ime',
            'surname' => 'Prezime',
            'email' => 'Email',
            'password' => 'Lozinka',
            'phone_number' => 'Broj telefona',
            'street_number' => 'Broj ulice',
            'role' => 'Rola',
            'street' => 'Ulica',
            'activated' => 'Nalog aktiviran'
        ];
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token =  Yii::$app->getSecurity()->generateRandomString();;
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

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 1,
            'activated' => 1
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = ArrayHelper::getValue(Yii::$app->params, 'user.passwordResetTokenExpire', 3600);

        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function resetPassword($password)
    {
        $this->setPassword($password);

        return $this->save(true, ['password_hash']);
    }

}
