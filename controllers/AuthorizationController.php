<?php

namespace app\controllers;

use app\components\helpers\interface\DBValidatorInterface;
use app\components\helpers\interface\UserGetInterface;
use app\components\helpers\UrlGen;
use app\exceptions\IDNotFoundException;
use app\models\auth\ChangePassForm;
use app\models\auth\ForgotPassForm;
use app\models\auth\RegistrationForm;
use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use app\models\auth\LoginForm;
use Exception;

class AuthorizationController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'registration', 'forgot-pass', 'change-pass'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout',],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm;

        if ($model->load(Yii::$app->request->post(), 'LoginForm') && $model->login()) {
            return $this->redirect(UrlGen::home());
        }

        return $this->render('login', compact('model'));
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post(), 'RegistrationForm') && $model->register()) {
            return $this->redirect(UrlGen::home());
        }

        return $this->render('registration', compact('model'));
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(UrlGen::home());
    }

    /**
     * Метод отвечает за страницу с формой для ввода почты пользователя,
     * пароль которого стоит изменить

     * Если юзер отправил форму, то выполняется операция отправки письма
     * с ссылкой на страницу изменения пароля при помощи метода ForgotPassForm::sendMessageToUserMail()
     * По завершению создаётся флеш-сессия с результатом операции.
     * @return string результат рендерирнга
     * @return Response — the current response object
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionForgotPass()
    {
        $model = new ForgotPassForm;

        if ($model->load(Yii::$app->request->post(), 'ForgotPassForm')) {
            try {
                $mailer = Yii::$app->mailer;
                $helper = Yii::$container->get(UserGetInterface::class);
                $model->sendMessageToUserMail($mailer, $helper);

                Yii::$app->session->setFlash('success', 'Письмо отправлено на почту. Следуйте инструкции...');
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(UrlGen::home());
        }

        return $this->render('forgot', compact('model'));
    }

    /**
     * Метод отвечает за страницу с формой для изменения пароля пользователя
     * 
     * В первую очередь проводится проверка на существование пользователя
     * с token = $token.
     * 
     * Далее, если юзер отправил форму, то выполняется операция изменения пароля
     * при помощи метода ChangePassForm::changePass(). По завершению, 
     * создаётся флеш-сессия с результатом операции.
     * @param string $token токен пользователя
     * @return string результат рендерирнга
     * @return Response — the current response object
     * @throws IDNotFoundException если пользователя с переданным токеном не существует
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionChangePass($token)
    {
        $validator = Yii::$container->get(DBValidatorInterface::class);

        if (!$validator->userByTokenExist($token)) {
            throw new IDNotFoundException('Пользователя с токеном ' . $token . ' не существует');
        }

        $model = new ChangePassForm;

        if ($model->load(Yii::$app->request->post(), 'ChangePassForm')) {
            try {
                $helper = Yii::$container->get(UserGetInterface::class);
                $user = $helper->getUserByToken($token);
                $model->changePass($user);

                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(UrlGen::home());
        }
        
        return $this->render('change', compact('model'));
    }
}