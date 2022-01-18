<?php

use app\components\helpers\UrlGen;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="" class="nav-link link-dark active">Уведомления</a></li>
                <li class="nav-item"><a href=<?= UrlGen::account('resume') ?> class="nav-link link-dark">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancie') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Уведомления</h2>
            <p class="text-center bg-light py-4 fw-light">Список пуст</p>
        </div>
    </div>
</div>
<!-- CONTENT -->