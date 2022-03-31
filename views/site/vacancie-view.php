<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;

$this->title = Yii::t('main', htmlspecialchars($vacancie->position));
?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <h1 class="h2 mb-5"><?= htmlspecialchars(ViewHelper::createVacancieTitle($vacancie)) ?></h1>
            <div class="row mb-3">
                <div class="col-sm-3"><b><?= Yii::t('main', 'Должность') ?></b></div>
                <div class="col-sm-9"><?= Yii::t('main', htmlspecialchars($vacancie->level)) ?> <?= htmlspecialchars($vacancie->position) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><b><?= Yii::t('main', 'Тип занятости') ?></b></div>
                <div class="col-sm-9"><?= Yii::t('main', htmlspecialchars($vacancie->type_of_work)) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><b><?= Yii::t('main', 'Место работы') ?></b></div>
                <div class="col-sm-9"><?= htmlspecialchars($vacancie->city) ?><?php  if ($vacancie->type_of_place) echo ', ' . Yii::t('main', htmlspecialchars($vacancie->type_of_place)) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><b><?= Yii::t('main', 'Компания') ?></b></div>
                <div class="col-sm-9">

                    <?php if ($vacancie->company_site): ?>
                        <a rel="noopener" target="_blank" href="<?= $vacancie->company_site ?>"><?= htmlspecialchars($vacancie->company) ?></a>
                    <?php else: ?>
                        <span><?= htmlspecialchars($vacancie->company) ?></span>
                    <?php endif ?>

                </div>
            </div>

            <?php if ($vacancie->experience): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Опыт') ?></b></div>
                    <div class="col-sm-9">
                        <?= $vacancie->experience ?>
                    </div>
                </div>
            <?php endif ?>
            
            <?php if ($vacancie->about_company): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'О компании') ?></b></div>
                    <div class="col-sm-9"><?= $vacancie->about_company ?></div>
                </div>
            <?php endif ?>

            <?php if ($vacancie->about_project): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'О проекте') ?></b></div>
                    <div class="col-sm-9"><?= $vacancie->about_project ?></div>
                </div>
            <?php endif ?>

            <?php if ($vacancie->technologies): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Технологии') ?></b></div>
                    <div class="col-sm-9"><?= htmlspecialchars($vacancie->technologies) ?></div>
                </div>
            <?php endif ?>

            <div class="row mb-3">
                <div class="col-sm-3"><b><?= Yii::t('main', 'Обязанности') ?></b></div>
                <div class="col-sm-9">
                    <?= $vacancie->duties ?>
                </div>
            </div>

            <?php if ($vacancie->requirements): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Требования') ?></b></div>
                    <div class="col-sm-9">
                        <?= $vacancie->requirements ?>
                    </div>
                </div>
            <?php endif ?>

            <?php if ($vacancie->conditions): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Условия и бонусы') ?></b></div>
                    <div class="col-sm-9">
                        <?= $vacancie->conditions ?>
                    </div>
                </div>
            <?php endif ?>

            <?php if ($salary = ViewHelper::createSalaryTitle($vacancie)): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Зарплата') ?></b></div>
                    <div class="col-sm-9"><?= htmlspecialchars($salary) ?></div>
                </div>
            <?php endif ?>

            <div class="alert bg-light shadow-sm text-muted"><?= Yii::t('main', 'При отклике на вакансию указывайте, что вы от Хекслета =)') ?></div>
            <h2 class="h3 mt-5 mb-4"><?= Yii::t('main', 'Похожие вакансии') ?></h2>
            
            <?php if ($similar_vacancies): ?>
                <?php foreach ($similar_vacancies as $sim_vacancie): ?>
                    <div class="lead">
                        <a href="<?= UrlGen::vacancie($sim_vacancie->id) ?>"><?= htmlspecialchars(ViewHelper::createVacancieTitle($sim_vacancie)) ?></a>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'На данный момент, похожих вакансий не найдено') ?></p>
            <?php endif ?>
            
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->