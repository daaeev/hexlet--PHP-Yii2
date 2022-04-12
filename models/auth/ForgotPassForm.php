<?php

namespace app\models\auth;

use app\components\helpers\interface\UserGetInterface;
use app\components\helpers\UrlGen;
use app\exceptions\IDNotFoundException;
use app\exceptions\MailSendException;
use app\exceptions\ValidationFailedException;
use yii\base\Model;
use app\models\User;
use yii\mail\MailerInterface;
use Yii;

/**
 * @property string $email
 */
class ForgotPassForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => User::class],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }

    /**
     * Метод отвечает за отправку письма с ссылкой на страницу
     * восстановления пароля на почту пользователя.
     * 
     * Сперва проводится валидация данных, после из базы данных
     * получается токен пользователя с указанной почтой и проверяется его наличие. 
     * 
     * Далее происходит отправка письма с ссылкой на страницу.
     * Если операция проходит успешно, метод возвращает true
     * @param MailerInterface $mailer объект для работы с отправкой писем на почту
     * @param UserGetInterface $userGetHelper объект для получения данных пользователей из БД
     * @return bool если операция пройдет успешно
     * @throws ValidationFailedException если валидация данных пройдет неуспешно
     * @throws IDNotFoundException если пользователь с указанной почтой не существует
     * @throws MailSendException если отправка письма прошла неуспешно
     */
    public function sendMessageToUserMail($mailer, $userGetHelper): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException(Yii::t('main','Валидация данных прошла неуспешно'));
        }

        $token = $userGetHelper->getUserTokenByEmail($this->email);

        $link = UrlGen::fullChangePassPage($token);
        $message = Yii::t('main',"Для изменения пароля, перейдите по следующей одноразовой ссылке") . " - $link";
        $letter = $mailer->compose()
            ->setFrom('') // УКАЖИТЕ АДРЕС ОТПРАВИТЕЛЯ
            ->setTo($this->email)
            ->setSubject(Yii::t('main','Восстановление пароля Hexlet'))
            ->setTextBody($message);

        if (!$letter->send()) {
            throw new MailSendException(Yii::t('main','При отправке письма произошла ошибка, попробуйте заново'));
        }

        return true;
    }
}