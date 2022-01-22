<?php

namespace app\models\auth;

use app\exceptions\AuthorizationFailedException;
use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
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
     * Метод отвечает за регистрацию пользователя
     * 
     * Сначала выполняется валидация данных.
     * 
     * После объект $user заполняется данными и сохраняется в базу.
     * 
     * Если пользователь установил флажок "Запомнить меня",
     * время его авторизации устанавливается на 24 часа. 
     * 
     * Вызывается метод yii\web\User::login()
     * для авторизации пользователя.
     * @param User $user экземпляр модели app\models\User
     * @param yii\base\Security $security предоставляет набор методов 
     * для решения общих задач, связанных с безопасностью
     * @param yii\web\User $userAuth экземпляр компонента приложения, 
     * который управляет статусом проверки подлинности пользователя
     * @return bool если операция регистрации пройдёт успешно
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранеине данных в БД пройдёт неуспешно
     * @throws AuthorizationFailedException если авторизация пользователя пройдёт неуспешно
     * @throws Exception если генерация хэша пройдёт неуспешно
     */
    public function register($user, $security, $userAuth): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }

        $user->email = $this->email;
        $user->password = $security->generatePasswordHash($this->password);
        if (!$user->save()) {
            throw new DBDataSaveException('Сохранение данных пользователя в БД прошло неуспешно');
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