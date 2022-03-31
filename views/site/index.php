<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;
use app\widgets\Alert;
use yii\bootstrap4\LinkPager;
use yii\i18n\Formatter;

$this->title = Yii::t('main', 'Главная страница');
?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <?= Alert::widget() ?>
            <h1><?= Yii::t('main', 'Резюме программистов') ?></h1>

            <div class="nav nav-pills justify-content-center mt-5">
                <a href="<?= UrlGen::allResumes() ?>" class="nav-item nav-link link-dark resume-all"><?= Yii::t('main', 'Все') ?></a>
                <a href="<?= UrlGen::allResumes('popular') ?>" class="nav-item nav-link link-dark resume-popular"><?= Yii::t('main', 'Популрные') ?></a>
                <a href="<?= UrlGen::allResumes('new') ?>" class="nav-item nav-link link-dark resume-new"><?= Yii::t('main', 'Новые') ?></a>
                <a href="<?= UrlGen::allResumes('norecomend') ?>" class="nav-item nav-link link-dark resume-norecomend"><?= Yii::t('main', 'Без рекомендаций') ?></a>
            </div>

            <div class="mt-5 card-block">

                <!-- CARD -->
                    <?php if ($data['elements']): ?>

                        <?php foreach ($data['elements'] as $resume): ?>
                            <div class="card card-noborder border-8 flex-row mb-4 pb-4">
                                <div class="social-info col-md-2 text-center text-nowrap me-3 small">
                                    <p class="text-muted mb-0 h2 fw-lighter"><?= count($resume->comments) ?></p>
                                    <p><?= Yii::t('main', ViewHelper::numToWord(count($resume->comments), ['ответ', 'ответа', 'ответов'])) ?></p>
                                    
                                    <p class="text-muted mb-0 h2 fw-lighter"><?= $resume->views ?></p>
                                    <p><?= Yii::t('main', ViewHelper::numToWord($resume->views, ['просмотр', 'просмотра', 'просмотров'])) ?></p>
                                </div>

                                <div class="card-info w-100">
                                    <h5 class="card-title"><a href="<?= UrlGen::resume($resume->id) ?>"><?= htmlspecialchars($resume->title) ?></a></h5>
                                    <p class="card-subtitle"><?= strip_tags(substr($resume->description, 0, 350)) ?>...</p>

                                    <div class="pub-info text-end mt-4 small">
                                        <span class="pub-date text-muted me-3"><?= (new Formatter)->asRelativeTime($resume->pub_date) ?></span>
                                        <a class="author" href="<?= UrlGen::profile($resume->author->id) ?>"><?= htmlspecialchars($resume->author->name) ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

                    <?php else: ?>
                        <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Список пуст') ?></p>
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

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>
    </div>
</div>
<!-- CONTENT -->