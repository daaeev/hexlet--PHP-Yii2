<?php

namespace app\controllers;

use app\models\auth\RegistrationForm;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use app\models\auth\LoginForm;

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
                        'actions' => ['login', 'registration'],
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
            return $this->redirect(Url::home());
        }

        return $this->render('login', compact('model'));
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post(), 'RegistrationForm') && $model->register()) {
            return $this->redirect(Url::home());
        }

        return $this->render('registration', compact('model'));
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::home());
    }
}