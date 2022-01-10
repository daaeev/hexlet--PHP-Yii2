<?php

use app\components\helpers\ViewHelper;
use app\widgets\Alert;
use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\i18n\Formatter;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <?= Alert::widget() ?>
            <h1>Вакансии для разработчиков</h1>

            <div class="mt-5 card-block">
                <?php if ($data['vacancies']): ?>

                    <!-- CARD -->
                        <?php foreach ($data['vacancies'] as $vacancie): ?>
                            <div class="card card-noborder border-8 mb-4 p-3 pb-4">
                                <div class="card-info">
                                    <span class="pub-date text-muted me-3 small"><?= (new Formatter)->asRelativeTime($vacancie->pub_date) ?></span>
                                    <h5 class="card-title"><a href="/vacancie/<?= $vacancie->id ?>"><?= ViewHelper::createVacancieTitle($vacancie) ?></a></h5>
                                    <p class="card-tasks mb-1"><?= substr($vacancie->duties, 0, 350) ?>...</p>
                                    <p class="card-skills fw-bold"><?= $vacancie->requirements ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <!-- CARD -->

                <?php else: ?>
                        <p class="text-center bg-light py-4 fw-light">Список вакансий пуст</p>
                <?php endif ?>

            </div>

            <?= LinkPager::widget([
                    'pagination' => $data['pagination'],
                    'options' => [
                        'class' => 'd-flex justify-content-center'
                    ]
                ]);
            ?>
        </div>

        <!-- ASIDE -->
        <aside class="col-md-3">
            <div class="bg-light rounded py-2 px-3">
                <p class="fs-4 mb-3">Последние ответы</p>

                <!-- CARD -->
                <div class="mb-4">
                    <p class="fw-bolder m-0"><a class="link-dark" href="#">Lorem, ipsum dolor</a></p>
                    <p class="small mb-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem libero blanditiis, odit corporis unde ut.</p>
                    <p class="small"><a href="#" class="link-dark">Alina Kobeleva</a></p>
                </div>
                <!-- CARD -->

            </div>
        </aside>
        <!-- ASIDE -->

    </div>
</div>
<!-- CONTENT -->