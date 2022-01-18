<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;
use yii\i18n\Formatter;

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
                        <div class="text-muted"><?= ViewHelper::numToWord(count($user->comments), ['ответ', 'ответа', 'ответов']) ?></div>
                    </div>
                    <div class="d-flex flex-column mx-1 mx-lg-3 text-center">
                        <div class="h3 text-black-50"><?= $likesCount ?></div>
                        <div class="text-muted"><?= ViewHelper::numToWord($likesCount, ['лайк', 'лайка', 'лайков']) ?></div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills justify-content-center" role="navigation">
                <li class="nav-item"><a class="nav-link px-3 active" href="#resume" data-bs-toggle="tab">Резюме</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#answers" data-bs-toggle="tab">Ответы</a></li>
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
                                            <p><?= ViewHelper::numToWord(count($resume->comments), ['ответ', 'ответа', 'ответов']) ?></p>
                                            
                                            <p class="text-muted mb-0 h2 fw-lighter"><?= $resume->views ?></p>
                                            <p><?= ViewHelper::numToWord($resume->views, ['просмотр', 'просмотра', 'просмотров']) ?></p>
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
                                <p class="text-center bg-light py-4 fw-light">Список пуст</p>
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
                        <p class="text-center bg-light py-4 fw-light">Список пуст</p>
                    <?php endif ?>

                </div>
            </div>
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