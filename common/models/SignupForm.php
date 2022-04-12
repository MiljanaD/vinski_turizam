<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $surname;
    public $email;
    public $password;
    public $passwordAgain;
    public $phoneNumber;
    public $adressId;
    public $streetNumber;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required', 'message' => 'Ovo polje je obavezno'],
            ['name', 'string', 'max' => 255],

            ['surname', 'trim'],
            ['surname', 'required', 'message' => 'Ovo polje je obavezno'],
            ['surname', 'string', 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Ovo polje je obavezno'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Ova email adresa je vec zauzeta.'],

            ['password', 'required', 'message' => 'Ovo polje je obavezno'],
            ['passwordAgain', 'required', 'message' => 'Ovo polje je obavezno'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['passwordAgain', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Lozinke se ne podudaraju"],

            ['phoneNumber', 'required', 'message' => 'Ovo polje je obavezno'],
            ['phoneNumber', 'string'],

//            ['adressId', 'required', 'message' => 'Ovo polje je obavezno'],

            ['streetNumber', 'required', 'message' => 'Ovo polje je obavezno'],
            ['streetNumber', 'number']


        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ime',
            'surname' => 'Prezime',
            'email' => 'Email',
            'password' => 'Lozinka',
            'passwordAgain' => 'Ponovljena lozinka',
            'phoneNumber' => 'Broj telefona',
            'adressId' => 'Ulica',
            'streetNumber' => 'Broj ulice'
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($street)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->surname = $this->surname;
        $user->street = intval($street);
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->phone_number = $this->phoneNumber;
        $user->street_number = intval($this->streetNumber);
//        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail']])
            ->setTo($this->email)
            ->setSubject('Registracija na ' . Yii::$app->name)
            ->send();
    }
}
