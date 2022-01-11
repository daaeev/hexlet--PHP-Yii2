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
            <h1>Резюме программистов</h1>

            <div class="nav nav-pills justify-content-center mt-5">
                <a href="<?= Url::to('/resume/all') ?>" class="nav-item nav-link link-dark resume-all">Все</a>
                <a href="<?= Url::to('/resume/popular') ?>" class="nav-item nav-link link-dark resume-popular">Популрные</a>
                <a href="<?= Url::to('/resume/new') ?>" class="nav-item nav-link link-dark resume-new">Новые</a>
                <a href="<?= Url::to('/resume/norecomend') ?>" class="nav-item nav-link link-dark resume-norecomend">Без рекомендация</a>
            </div>

            <div class="mt-5 card-block">

                <!-- CARD -->
                    <?php if ($data['resumes']): ?>

                        <?php foreach ($data['resumes'] as $resume): ?>
                            <div class="card card-noborder border-8 flex-row mb-4 pb-4">
                                <div class="social-info col-md-2 text-center text-nowrap me-3 small">
                                    <p class="text-muted mb-0 h2 fw-lighter"><?= count($resume->comments) ?></p>
                                    <p><?= ViewHelper::numToWord(count($resume->comments), ['ответ', 'ответа', 'ответов']) ?></p>
                                    
                                    <p class="text-muted mb-0 h2 fw-lighter"><?= $resume->views ?></p>
                                    <p><?= ViewHelper::numToWord($resume->views, ['просмотр', 'просмотра', 'просмотров']) ?></p>
                                </div>

                                <div class="card-info w-100">
                                    <h5 class="card-title"><a href="/resume/<?= $resume->id ?>"><?= htmlspecialchars($resume->title) ?></a></h5>
                                    <p class="card-subtitle"><?= htmlspecialchars(substr($resume->description, 0, 350)) ?>...</p>

                                    <div class="pub-info text-end mt-4 small">
                                        <span class="pub-date text-muted me-3"><?= (new Formatter)->asRelativeTime($resume->pub_date) ?></span>
                                        <a class="author" href="#"><?= htmlspecialchars($resume->author->name) ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

                    <?php else: ?>
                        <p class="text-center bg-light py-4 fw-light">Список пуст</p>
                    <?php endif ?>
                <!-- CARD -->

            </div>

            <?= LinkPager::widget([
                    'pagination' => $data['pagination'],
                    'options' => [
                        'class' => 'd-flex justify-content-center'
                    ]
                ]);
            ?>
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