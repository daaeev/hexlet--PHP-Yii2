<?php

namespace app\models\auth;

use yii\base\Model;
use app\models\User;
use Yii;

/**
 * @property string email
 * @property string password
 * @property string password_repeat
 * @property int remember_me
 */
class RegistrationForm extends Model
{
    public $email;
    public $password;
    public $password_repeat;
    public $remember_me;

    public function rules()
    {
        return [
            [['email', 'password', 'password_repeat'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => '6'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['remember_me', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Confirm password',
        ];
    }

    /**
     * Занесение данных пользователя в бд при успешной валидации
     * @return bool
     * */
    public function register()
    {
        if ($this->validate()) {
            if ($user = $this->createUser()) {
                $duration = 0;

                if ($this->remember_me) {
                    $duration = 3600 * 24;
                }
                
                Yii::$app->user->login($user, $duration);
            
                return true;
            }
        }
        
        return false;
    }

    /**
     * Создание объекта типа User
     * @return User
     * */
    protected function createUser(): User
    {
        $user = new User;
        $user->email = $this->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->save();

        return $user;
    }
}