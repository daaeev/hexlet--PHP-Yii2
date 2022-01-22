<?php

namespace app\models\auth;

use app\components\helpers\interface\UserGetInterface;
use app\exceptions\AuthorizationFailedException;
use app\exceptions\IDNotFoundException;
use app\exceptions\ValidationFailedException;
use yii\base\Model;
use app\models\User;

/**
 * @property string $email
 * @property string $password
 * @property int $remember_me
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
     * Метод отвечает за авторизацию пользователя.
     * 
     * Сначала выполняется валидация данных. 
     * После из базы данных достается User с email = $this->email
     * при помощи метода UserGetInterface::getUserByEmail().
     * 
     * Далее происходит проверка схожести введённого пароля и
     * хеш-пароля из базы данных, используя метод yii\base\Security::validatePassword().
     * 
     * Если пользователь установил флажок "Запомнить меня",
     * время его авторизации устанавливается на 24 часа. 
     * 
     * Вызывается метод yii\web\User::login()
     * для авторизации пользователя.
     * @param UserGetInterface $userGetHelper объект для получения данных пользователей из БД
     * @param yii\base\Security $security предоставляет набор методов 
     * для решения общих задач, связанных с безопасностью
     * @param yii\web\User $userAuth экземпляр компонента приложения, 
     * который управляет статусом проверки подлинности пользователя
     * @return bool при успешной авторизации пользователя
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws IDNotFoundException если пользователь с почтой $this->email не существует
     * @throws AuthorizationFailedException если авторизация пользователя пройдёт неуспешно
     * @throws Exception если валидация пароля пройдёт неуспешно
     */
    public function login($userGetHelper, $security, $userAuth): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }

        $user = $userGetHelper->getUserByEmail($this->email);

        if (!$user) {
            throw new IDNotFoundException('Пользователя с почтой ' . $this->email . ' не существует');
        }

        if (!$security->validatePassword($this->password, $user->password)) {
            throw new ValidationFailedException('Пароли не совпадают');
        }

        $duration = 0;

        if ($this->remember_me) {
            $duration = 3600 * 24;
        }

        if (!$userAuth->login($user, $duration)) {
            throw new AuthorizationFailedException('Авторизация пользователя прошла неуспешно');
        }
        
        return true;
    }
}