<?php

namespace app\controllers;

use yii\web\Controller;
use yii;
use yii\helpers\Url;

class AuthorizationController extends Controller
{
    public $layout = 'auth';

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
        return $this->render('login');
    }

    public function actionRegistration()
    {
        return $this->render('registration');
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::home());
    }
}