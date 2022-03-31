<?php

$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/resume',
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IsThyVD7Zt3tTHYtupYHoye4X8oqtMMg',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'loginUrl' => '/login',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'ru'],
            'enableDefaultLanguageUrlCode' => true,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'resume/<category:\D{0,10}>' => 'site/resume',
                'vacancies' => 'site/vacancies',
                'vacancies/filters' => 'site/vacancies-filters',
                'rating' => 'site/rating',
                'account/<tab:\D{6,9}>' => 'site/account',
                'create/resume' => 'site/create-resume',
                'create/vacancie' => 'site/create-vacancie',
                'profile/<id:\d+>' => 'site/profile',
                'resume/<id:\d+>' => 'site/resume-view',
                'resume/like/<id:\d+>' => 'site/do-like',
                'resume/edit/<id:\d+>' => 'site/resume-edit',
                'vacancie/<id:\d+>' => 'site/vacancie-view',
                'account/delete-notify/<notify_id:\d+>' => 'site/delete-notify',
                'about' => 'site/about',

                'create-comment/<resume_id:\d+>/<parent_comment_id:\d+>' => 'site/create-comment',
                'create-comment/<resume_id:\d+>' => 'site/create-comment',

                'login' => 'authorization/login',
                'registration' => 'authorization/registration',
                'logout' => 'authorization/logout',
                'forgot-pass' => 'authorization/forgot-pass',
                'change-pass' => 'authorization/change-pass',
                'email/confirm' => 'authorization/email-confirm',
                'email/send-confirm' => 'site/send-mail-to-confirm',
            ],
        ],
        'i18n' => [
            'translations' => [
                'main' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'ru',
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',

                // Также указать в 
                // SiteController::actionSendMailToConfirm()
                // ForgotPassForm::sendMessageToUserMail()
                'username' => 'LfdblGbhju@gmail.com', // УКАЗАТЬ АДРЕС

                'password' => 'nibibqmrqfxlxnra', // УКАЗАТЬ ПАРОЛЬ
                'port' => '587',
                'encryption' => 'tls',
            ] 
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
