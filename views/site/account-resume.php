<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Мои резюме</h2>

            <?php if ($resumes): ?>
                <?php foreach ($resumes as $resume): ?>
                    <div class="card mb-3">
                        <?= ViewHelper::resumeStatus($resume->status, $resume->id) ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($resume->title) ?></h5>
                            <div class="card-text">
                                <p><?= $resume->description ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p class="text-center bg-light py-4 fw-light">Список пуст</p>
            <?php endif ?>

        </div>
    </div>
</div>
<!-- CONTENT -->