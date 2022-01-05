<?php

use app\assets\MainAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

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
            <a class="navbar-brand link-dark" href="<?= Url::home() ?>">Hexlet CV</a>
            <div class="nav-menu">
                <a class="link link-dark" href="<?= Url::to('/resume/all') ?>">Резюме</a>
                <a class="link link-dark" href="<?= Url::to('/vacancies') ?>">Вакансии</a>
                <a class="link link-dark" href="<?= Url::to('/rating') ?>">Рейтинг</a>

                <?php if (Yii::$app->user->can('adminPanel')): ?>
                    <a class="link link-dark" href="<?= Url::to('/admin/user') ?>">Админ панель</a>
                <?php endif ?>

            </div>
        </div>

    <?php if (Yii::$app->user->isGuest): ?>

        <div class="right-block d-flex align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link link-dark" href="<?= Url::to('/login') ?>">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" href="<?= Url::to('/registration') ?>">Регистрация </a>
                </li>
            </ul>
        </div>

    <?php else: ?>

        <div class="right-block d-flex align-items-center">
            <a class="notify-link block-element link-dark" href="<?= Url::to('/account/notify') ?>"><i class="bi bi-bell"></i></a>

            <div class="dropdown block-element">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Добавить
                </button>
                <ul class="dropdown-menu add-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="<?= Url::to('/create/resume') ?>">Резюме</a></li>
                    <li><a class="dropdown-item" href="<?= Url::to('/create/vacancie') ?>">Вакансию</a></li>
                </ul>
            </div>
            
            <div class="dropdown block-element">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </button>
                <ul class="dropdown-menu profile-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="dropdown-item user-info">
                        <span class="username">User</span><br>
                        <span class="email">lfdblgbhju@gmail.com</span>
                    </li>
                    <li><a class="dropdown-item" href="<?= Url::to('/profile') ?>">Мой профиль</a></li>
                    <li><a class="dropdown-item" href="<?= Url::to('/account/resume') ?>">Мои резюме</a></li>
                    <li><a class="dropdown-item" href="<?= Url::to('/account/vacancies') ?>">Мои вакансии</a></li>
                    <li><a class="dropdown-item" href="<?= Url::to('/account/settings') ?>">Настройки</a></li>
                    <li><a class="dropdown-item btn-logout" href="<?= Url::to('/logout') ?>">Выход</a></li>
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
