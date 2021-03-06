<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;
use yii\i18n\Formatter;

$this->title = Yii::t('main', 'Профиль');
?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <div class="profile_info bg-light px-3 py-4 mb-3 rounded">
                <h1 class="text-center"><?= htmlspecialchars($user->name) ?></h1>
                <p class="text-center"><?= htmlspecialchars($user->contribution) ?></p>
                <div class="d-flex justify-content-center mt-4">
                    <div class="d-flex flex-column mx-1 mx-lg-3 text-center">
                        <div class="h3 text-black-50"><?= count($user->comments) ?></div>
                        <div class="text-muted"><?= Yii::t('main', ViewHelper::numToWord(count($user->comments), ['ответ', 'ответа', 'ответов'])) ?></div>
                    </div>
                    <div class="d-flex flex-column mx-1 mx-lg-3 text-center">
                        <div class="h3 text-black-50"><?= $likesCount ?></div>
                        <div class="text-muted"><?= Yii::t('main', ViewHelper::numToWord($likesCount, ['лайк', 'лайка', 'лайков'])) ?></div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills justify-content-center" role="navigation">
                <li class="nav-item"><a class="nav-link px-3 active" href="#resume" data-bs-toggle="tab"><?= Yii::t('main','Резюме') ?></a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#answers" data-bs-toggle="tab"><?= Yii::t('main','Ответы') ?></a></li>
            </ul>

            <div class="tab-content py-3">
                <div class="tab-pane fade active show" id="resume">
                    <div class="card-block">

                        <!-- CARD -->
                            <?php if ($user->resumes): ?>

                                <?php foreach ($user->resumes as $resume): ?>
                                    <div class="card border-8 flex-row mb-4 p-3">
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
                </div>
                <div class="tab-pane fade" id="answers">
                    <?php if ($user->comments): ?>
                        <?php foreach ($user->comments as $comment): ?>
                            <!-- CARD -->
                            <div class="card mb-3">
                                <p class="card-header"><a href="<?= UrlGen::resume($comment->resume->id) ?>"><?= $comment->resume->title ?></a></p>
                                <div class="card-body">
                                    <div class="card-text"><?= $comment->content ?></div>
                                </div>
                            </div>
                            <!-- CARD -->
                        <?php endforeach ?>
                    <?php else: ?>
                        <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Список пуст') ?></p>
                    <?php endif ?>

                </div>
            </div>
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->