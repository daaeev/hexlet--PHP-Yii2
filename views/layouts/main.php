<?php

use app\assets\MainAsset;
use app\components\helpers\UrlGen;
use yii\bootstrap4\Html;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

    <header class="container-md navbar">
        <div class="left-block d-flex align-items-center">        
            <a class="navbar-brand link-dark" href="<?= UrlGen::home() ?>">Hexlet CV</a>
            <div class="nav-menu">
                <a class="link link-dark" href="<?= UrlGen::allResumes() ?>"><?= Yii::t('main', 'Резюме') ?></a>
                <a class="link link-dark" href="<?= UrlGen::allVacancies() ?>"><?= Yii::t('main', 'Вакансии') ?></a>
                <a class="link link-dark" href="<?= UrlGen::rating() ?>"><?= Yii::t('main', 'Рейтинг') ?></a>

                <?php if (Yii::$app->user->can('adminPanel')): ?>
                    <a class="link link-dark" href="<?= UrlGen::adminPanel() ?>"><?= Yii::t('main', 'Админ панель') ?></a>
                <?php endif ?>
            </div>
            <div class="px-3 dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= Yii::t('main', 'Язык') ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><?= Html::a('Русский', ['/', 'language' => 'ru'], ['class' => 'dropdown-item']) ?></li
                    <li><?= Html::a('English', ['/', 'language' => 'en'], ['class' => 'dropdown-item']) ?></li>
                </ul>
            </div>
        </div>

    <?php if (Yii::$app->user->isGuest): ?>

        <div class="right-block d-flex align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link link-dark" href="<?= UrlGen::login() ?>"><?= Yii::t('main', 'Войти') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" href="<?= UrlGen::registration() ?>"><?= Yii::t('main', 'Регистрация') ?> </a>
                </li>
            </ul>
        </div>

    <?php else: ?>

        <div class="right-block d-flex align-items-center">
            <?php if ($this->params['have_notification']): ?>
                <a class="notify-link block-element link-dark" href="<?= UrlGen::account() ?>"><i class="bi bi-bell-fill text-danger"></i></a>
            <?php else: ?>
            <a class="notify-link block-element link-dark" href="<?= UrlGen::account() ?>"><i class="bi bi-bell"></i></a>
            <?php endif ?>

            <div class="dropdown block-element">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= Yii::t('main', 'Добавить') ?>
                </button>
                <ul class="dropdown-menu add-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="<?= UrlGen::createPage('resume') ?>"><?= Yii::t('main', 'Резюме') ?></a></li>
                    <li><a class="dropdown-item" href="<?= UrlGen::createPage('vacancie') ?>"><?= Yii::t('main', 'Вакансию') ?></a></li>
                </ul>
            </div>
            
            <div class="dropdown block-element">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </button>
                <ul class="dropdown-menu profile-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="dropdown-item user-info">
                        <span class="username"><?= htmlspecialchars($this->params['user']->name) ?></span><br>
                        <span class="email"><?= htmlspecialchars($this->params['user']->email) ?></span>
                    </li>
                    <li><a class="dropdown-item" href="<?= UrlGen::profile($this->params['user']->id) ?>"><?= Yii::t('main', 'Мой профиль') ?></a></li>
                    <li><a class="dropdown-item" href="<?= UrlGen::account('resume') ?>"><?= Yii::t('main', 'Мои резюме') ?></a></li>
                    <li><a class="dropdown-item" href="<?= UrlGen::account('vacancie') ?>"><?= Yii::t('main', 'Мои вакансии') ?></a></li>
                    <li><a class="dropdown-item" href="<?= UrlGen::account('settings') ?>"><?= Yii::t('main', 'Настройки') ?></a></li>
                    <li><a class="dropdown-item btn-logout" href="<?= UrlGen::logout() ?>"><?= Yii::t('main', 'Выход') ?></a></li>
                </ul>
            </div>
        </div>

    <?php endif ?>

    </header>

    <?= $content ?>

    <footer class="bg-light border-top mt-auto py-5">
        <div class="container-md">
            <div class="row justify-content-lg-around">
                <div class="col-sm-6 col-md-4 col-lg-auto">
                    <p class="fs-4 mb-2">Hexlet ©</p>
                    <ul class="list-unstyled">
                        <li><a href="<?= UrlGen::aboutPage() ?>" class="link-dark">О проекте</a></li>
                        <li><a href="#" class="link-dark">Link</a></li>
                        <li><a href="#" class="link-dark">Link</a></li>
                    </ul>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-auto">
                    <p class="fs-4 mb-2">Title</p>
                    <ul class="list-unstyled">
                        <li><a href="#" class="link-dark">Link</a></li>
                        <li><a href="#" class="link-dark">Link</a></li>
                        <li><a href="#" class="link-dark">Link</a></li>
                    </ul>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-auto">
                    <p class="fs-4 mb-2">Title</p>
                    <ul class="list-unstyled">
                        <li><a href="#" class="link-dark">Link</a></li>
                        <li><a href="#" class="link-dark">Link</a></li>
                        <li><a href="#" class="link-dark">Link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
