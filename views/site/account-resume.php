<?php

use yii\helpers\Url;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= Url::to('/account/notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/vacancies') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/settings') ?>" class="nav-link link-dark">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Мои резюме</h2>
        <!--
            <div class="card mb-3">
                <p class="card-header">Черновик<span class="ms-3"><a href="#"><span class="bi bi-pencil-square text-muted"></span></a></span></p>
                <div class="card-body">
                    <h5 class="card-title">Something title</h5>
                    <div class="card-text">
                        <p>Something content</p>
                    </div>
                </div>
            </div>
        -->
            <p class="text-center bg-light py-4 fw-light">Список пуст</p>
        </div>
    </div>
</div>
<!-- CONTENT -->