<?php

use app\components\helpers\ViewHelper;
use yii\helpers\Url;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= Url::to('/account/notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/resume') ?>" class="nav-link link-dark">Мои резюме</a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active">Мои вакансии</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/settings') ?>" class="nav-link link-dark">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Мои вакансии</h2>

            <?php if ($vacancies): ?>
                <?php foreach ($vacancies as $vacancie): ?>
                    <div class="card mb-3">
                        <?= ViewHelper::introduceStatus($vacancie->status, "/vacancie/$vacancie->id") ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars(ViewHelper::createVacancieTitle($vacancie)) ?></h5>
                            <div class="card-text">
                                <p><?= $vacancie->duties ?></p>
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