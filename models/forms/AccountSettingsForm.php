<?php

namespace app\models\forms;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\User;
use PHPUnit\Framework\MockObject\MockObject;
use yii\base\Model;

class AccountSettingsForm extends Model
{
    /**
     * Никнейм пользователя на сайте.
     * Если пользователь в форме не указал его,
     * значение будет равно Anonymous
     */
    public $user_name;
    
    public $contribution;

    public function rules()
    {
        return [
            ['user_name', 'string', 'max' => 255, 'min' => 3],
            ['contribution', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_name' => 'Имя, фамилия',
            'contribution' => 'Обо мне',
        ];
    }

    /**
     * Метод сохраняет данные пользователя из формы 
     * (никнейм и описание) в бд
     * @param User $user экземпляр модели пользователя
     * @return bool если операция прошла успешно
     * @throws ValidationFailedException если Валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных пройдёт неуспешно
     */
    public function saveUserSettings($user): bool
    {
        if ($this->validate()) {
            $user->name = $this->user_name;
            $user->contribution = $this->contribution;

            if ($user->save()) {
                return true;
            }

            throw new DBDataSaveException('Сохранение данных в бд прошло неуспешно. Побробуйте ещё раз');
        }

        throw new ValidationFailedException('Данные из формы не прошли валидацию. Проверьте введённые данные');
    }
}