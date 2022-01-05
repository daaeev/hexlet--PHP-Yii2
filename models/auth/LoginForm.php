<?php

namespace app\models\auth;

use yii\base\Model;
use app\models\User;
use Yii;

/**
 * @property string email
 * @property string password
 * @property int remember_me
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $remember_me;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => User::class],
            ['password', 'string', 'min' => '6'],
            ['remember_me', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * Авторизация пользователя при успешной валидации
     * @return bool
     * */
    public function login()
    {
        if ($this->validate()) {
            $user = User::findOne(['email' => $this->email]);

            if ($user) {
                if (Yii::$app->getSecurity()->validatePassword($this->password, $user->password)) {
                    $duration = 0;

                    if ($this->remember_me) {
                        $duration = 3600 * 24;
                    }

                    Yii::$app->user->login($user, $duration);
                    
                    return true;
                } else {
                    $this->addError('password', 'Wrong password');
                }
            }
        }
        
        return false;
    }
}