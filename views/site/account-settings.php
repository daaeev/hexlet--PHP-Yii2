<?php

use yii\helpers\Url;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= Url::to('/account/notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/resume') ?>" class="nav-link link-dark">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/vacancies') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Настройки</h2>

            <form action="" method="">
                <div class="mb-3">
                    <label class="string optional" for="user_name">Имя</label>
                    <input type="text" class="form-control" id="user_name">
                </div>

                <div class="mb-3">
                    <label class="string optional" for="user_last_name">Фамилия</label>
                    <input type="text" class="form-control" id="user_last_name">
                </div>

                <div class="mb-3">
                    <label class="string optional" for="about">Обо мне</label>
                    <textarea type="text" class="form-control" id="about"></textarea>
                </div>

                <div class="mb-3">
                    <input type="button" class="btn btn-primary" value="Изменить">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CONTENT -->