<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends User
{
    public $email;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            $hash = $user->password;
            if (!$user || !Yii::$app->getSecurity()->validatePassword($this->password, $hash)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login($password)
    {
        $user = $this->getUser();
        if(Roles::find()->where(['id' => $user->role])->one()->role == 'admin')
        {
            Yii::$app->session->set('admin',true);
        }
        else
        {
            Yii::$app->session->set('admin',false);
        }
        if ($this->validate()) {
            if(Yii::$app->session->get('admin'))
            {
                return Yii::$app->user->login($user);
            }
            else {
                if($user->activated == 1) {
                    return Yii::$app->user->login($user);
                }
                else{
                    Yii::$app->session->setFlash('error','Nalog nije aktiviran od strane admina');
                    return false;
                }
            }
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
