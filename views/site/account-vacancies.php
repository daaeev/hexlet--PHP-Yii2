<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Уведомления') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои резюме') ?></a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active"><?= Yii::t('main', 'Мои вакансии') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Настройки') ?></a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4"><?= Yii::t('main', 'Мои вакансии') ?></h2>

            <?php if ($vacancies): ?>
                <?php foreach ($vacancies as $vacancie): ?>
                    <div class="card mb-3">
                        <?= ViewHelper::vacancieStatus($vacancie->status, $vacancie->id) ?>
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