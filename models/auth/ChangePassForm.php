<?php 

namespace app\models\auth;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\User;
use Exception;
use Yii;
use yii\base\Model;

/**
 * @property string $password
 * @property string $password_repeat
 */
class ChangePassForm extends Model
{
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'password_repeat' => 'Confirm password',
        ];
    }

    /**
     * Метод отвечает за изменение парля пользователя
     * 
     * Сперва проходит валидация данных, после хешируется и присваивается
     * новый пароль с новым сгенерированным токеном.
     * 
     * Далее происходит сохранение данных в БД и воозврат true
     * при успешном прохождении валидации и сохранения
     * @param User $user экземпляр модели пользователя с переданным токеном
     * @param yii\base\Security $security предоставляет набор методов 
     * для решения общих задач, связанных с безопасностью
     * @return bool если операция валидации и сохранения пройдёт успешно
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных в БД пройдёт неуспешно
     * @throws Exception если генерация хэша/строки пройдёт неуспешно
     */
    public function changePass($user, $security): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException(Yii::t('main','Валидация данных прошла неуспешно'));
        }

        $user->password = $security->generatePasswordHash($this->password);
        $user->token = $security->generateRandomString(32);

        if (!$user->save()) {
            throw new DBDataSaveException(Yii::t('main','Сохранение данных пользователя прошло неуспешо'));
        }

        return true;
    }
}