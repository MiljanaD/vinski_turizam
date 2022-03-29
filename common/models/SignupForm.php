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
    public $ime;
    public $prezime;
    public $email;
    public $lozinka;
    public $lozinkaPonovo;
    public $brojTelefona;
    public $id_adrese;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['ime', 'trim'],
            ['ime', 'required', 'message' => 'Ovo polje je obavezno'],
            ['ime', 'string', 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Ovo polje je obavezno'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Ova email adresa je vec zauzeta.'],

            ['lozinka', 'required', 'message' => 'Ovo polje je obavezno'],
            ['lozinkaPonovo', 'required', 'message' => 'Ovo polje je obavezno'],
            ['lozinka', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['lozinkaPonovo', 'compare', 'compareAttribute'=>'lozinka', 'skipOnEmpty' => false, 'message'=>"Lozinke se ne podudaraju"],

            ['brojTelefona', 'required', 'message' => 'Ovo polje je obavezno'],
            ['brojTelefona', 'string']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->ime = $this->ime;
        $user->email = $this->email;
        $user->lozinka = $this->lozinka;
        $user->broj_telefona = $this->brojTelefona;
//        $user->generateAuthKey();
//        $user->generateEmailVerificationToken();

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
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
