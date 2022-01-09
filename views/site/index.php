<?php

use app\widgets\Alert;
use yii\helpers\Url;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <?= Alert::widget() ?>
            <h1>Резюме программистов</h1>

            <div class="nav nav-pills justify-content-center mt-5">
                <a href="<?= Url::to('/resume/all') ?>" class="nav-item nav-link link-dark resume-all">Все</a>
                <a href="<?= Url::to('/resume/popular') ?>" class="nav-item nav-link link-dark resume-popular">Популрные</a>
                <a href="<?= Url::to('/resume/new') ?>" class="nav-item nav-link link-dark resume-new">Новые</a>
                <a href="<?= Url::to('/resume/norecomend') ?>" class="nav-item nav-link link-dark resume-norecomend">Без рекомендация</a>
            </div>

            <div class="mt-5 card-block">

                <!-- CARD -->
                <div class="card card-noborder border-8 flex-row mb-4 pb-4">
                    <div class="social-info col-md-2 text-center text-nowrap me-3 small">
                        <p class="text-muted mb-0 h2 fw-lighter">1</p>
                        <p>Ответ</p>
                        
                        <p class="text-muted mb-0 h2 fw-lighter">1</p>
                        <p>Просмотр</p>
                    </div>

                    <div class="card-info">
                        <h5 class="card-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                        <p class="card-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur blanditiis delectus eos accusamus quibusdam molestias officiis. Placeat, delectus assumenda. Rerum repudiandae labore aperiam nisi non perspiciatis pariatur vel numquam ab.</p>

                        <div class="pub-info text-end mt-4 small">
                            <span class="pub-date text-muted me-3">2 дня назад</span>
                            <a class="author" href="#">Акакий Епик</a>
                        </div>
                    </div>
                </div>
                <!-- CARD -->

            </div>
        </div>

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
    </div>
</div>
<!-- CONTENT -->