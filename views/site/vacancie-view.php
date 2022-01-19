<?php

use app\components\helpers\ViewHelper;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <h1 class="h2 mb-5"><?= htmlspecialchars(ViewHelper::createVacancieTitle($vacancie)) ?></h1>
            <div class="row mb-3">
                <div class="col-sm-3"><b>Должность</b></div>
                <div class="col-sm-9"><?= htmlspecialchars($vacancie->level) ?> <?= htmlspecialchars($vacancie->position) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><b>Тип занятости</b></div>
                <div class="col-sm-9"><?= htmlspecialchars($vacancie->type_of_work) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><b>Место работы</b></div>
                <div class="col-sm-9"><?= htmlspecialchars($vacancie->city) ?><?php  if ($vacancie->type_of_place) echo htmlspecialchars(", $vacancie->type_of_place") ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><b>Компания</b></div>
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
                    <div class="col-sm-3"><b>Опыт</b></div>
                    <div class="col-sm-9">
                        <?= $vacancie->experience ?>
                    </div>
                </div>
            <?php endif ?>
            
            <?php if ($vacancie->about_company): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>О компании</b></div>
                    <div class="col-sm-9"><?= $vacancie->about_company ?></div>
                </div>
            <?php endif ?>

            <?php if ($vacancie->about_project): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>О проекте</b></div>
                    <div class="col-sm-9"><?= $vacancie->about_project ?></div>
                </div>
            <?php endif ?>

            <?php if ($vacancie->technologies): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Технологии</b></div>
                    <div class="col-sm-9"><?= htmlspecialchars($vacancie->technologies) ?></div>
                </div>
            <?php endif ?>

            <div class="row mb-3">
                <div class="col-sm-3"><b>Обязанности</b></div>
                <div class="col-sm-9">
                    <?= $vacancie->duties ?>
                </div>
            </div>

            <?php if ($vacancie->requirements): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Требования</b></div>
                    <div class="col-sm-9">
                        <?= $vacancie->requirements ?>
                    </div>
                </div>
            <?php endif ?>

            <?php if ($vacancie->conditions): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Условия и Бонусы</b></div>
                    <div class="col-sm-9">
                        <?= $vacancie->conditions ?>
                    </div>
                </div>
            <?php endif ?>

            <?php if ($salary = ViewHelper::createSalaryTitle($vacancie)): ?>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Зарплата</b></div>
                    <div class="col-sm-9"><?= htmlspecialchars($salary) ?></div>
                </div>
            <?php endif ?>

            <div class="alert bg-light shadow-sm text-muted">При отклике на вакансию указывайте, что вы от Хекслета =)</div>
            <h2 class="h3 mt-5 mb-4">Похожие вакансии</h2>
            <div class="lead">
                <a href="#">Джуниор React в городеМосква</a>
            </div>
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->