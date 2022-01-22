<?php 

namespace app\models\auth;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\User;
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
     * @return bool если операция валидации и сохранения пройдёт успешно
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных в БД пройдёт неуспешно
     */
    public function changePass($user): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }

        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->token = Yii::$app->getSecurity()->generateRandomString(32);

        if (!$user->save()) {
            throw new DBDataSaveException('Сохранение данных пользователя прошло неуспешо');
        }

        return true;
    }
}