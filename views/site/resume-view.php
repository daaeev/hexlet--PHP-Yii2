<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\i18n\Formatter;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <?= Alert::widget() ?>
            <div class="mb-5">
                <div class="d-flex">
                    <h4 class="mb-4 me-3">Основное</h4>
                    <hr class="my-auto w-100">
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Имя</b></div>
                    <div class="col-sm-9"><a href="<?= UrlGen::profile($resume->author->id) ?>"><?= htmlspecialchars($resume->author->name) ?></a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Описание</b></div>
                    <div class="col-sm-9">
                        <p><?= $resume->description ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><b>Навыки</b></div>
                    <div class="col-sm-9">
                        <p><?= $resume->skills ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><b>Владение английским</b></div>
                    <div class="col-sm-9">
                        <p><?= htmlspecialchars($resume->english) ?></p>
                    </div>
                </div>
                <div class="row mt-3 mb-4">
                    <div class="col-sm-3"><b>Github</b></div>
                    <div class="col-sm-9"><a rel="noopener" href="<?= $resume->github ?>"><?= htmlspecialchars($resume->github) ?></a></div>
                </div>

                <?php if ($resume->contact) : ?>
                    <div class="row mt-3 mb-4">
                        <div class="col-sm-3"><b>Контакт</b></div>
                        <div class="col-sm-9"><?= htmlspecialchars($resume->contact) ?></div>
                    </div>
                <?php endif ?>

                <?php if ($resume->achievements) : ?>
                    <div class="row mt-3 mb-4">
                        <div class="col-sm-3"><b>Достижения</b></div>
                        <div class="col-sm-9"><?= $resume->achievements ?></div>
                    </div>
                <?php endif ?>

                <hr>
            </div>

            <div class="lead mb-3">Рекомендации</div>

            <?php if ($resume->comments) : ?>
                <?php foreach ($resume->comments as $comment) : if ($comment->parent_comment_id) continue; ?>
                    <div class="card mb-4" id="answer-344">
                        <div class="card-header small mb-2 d-flex">
                            <div class="me-auto d-flex">
                                <span class="fw-bold"><a href="<?= UrlGen::profile($comment->author->id) ?>"><?= htmlspecialchars($comment->author->name) ?></a></span>
                                <span class="mx-2 fw-light text-muted"><?= (new Formatter)->asRelativeTime($comment->pub_date) ?></span>
                            </div>
                        </div>
                        <div class="card-body d-flex">
                            <div class="me-3 h4">
                                <p class="text-center text-muted mb-2 mt-1 fw-light"><?= count($comment->likes) ?></p>
                                <a class="text-decoration-none" href="<?= UrlGen::commentLike($comment->id) ?>" data-method='<?= ViewHelper::createDataMethod($comment->id) ?>'>
                                    <span class="bi bi-hand-thumbs-up text-secondary"></span>
                                </a>
                            </div>
                            <div class="w-100">
                                <div class="mb-3">
                                    <p><?= $comment->content ?></p>
                                </div>
                                <hr class="my-2">

                                <?php if ($comment->comments): ?>
                                    <?php foreach ($comment->comments as $childComment): ?>
                                        <div class="small comment">
                                            <div class="d-flex">
                                                <div class="me-auto">
                                                    <span class="me-2">
                                                        <p><?= $childComment->content ?></p>
                                                    </span>
                                                    <span class="me-1"><a href="<?= UrlGen::profile($childComment->author->id) ?>"><?= htmlspecialchars($childComment->author->name) ?></a></span>
                                                    <span class="small text-muted"><?= (new Formatter)->asRelativeTime($childComment->pub_date) ?></span>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-2">
                                        </div>
                                    <?php endforeach ?>
                                <?php endif ?>

                                <a class="d-block small text-muted" data-bs-toggle="collapse" href="#answer-<?= $comment->id ?>">Добавить комментарий</a>
                                <div class="collapse" id="answer-<?= $comment->id ?>">

                                    <?php $form = ActiveForm::begin(['action' => "/create-comment/$resume->id/$comment->id"]) ?>
                                        <div class="mb-3">
                                            <?= $form->field($comment_form, 'content')->textarea()->label(false) ?>
                                            <small class="form-text text-muted">Длина не может превышать 200 символов</small>
                                        </div>

                                        <div class="mb-3">
                                            <input type="submit" name="commit" value="Создать" class="btn btn-primary" data-disable-with="Создать">
                                        </div>
                                    <?php ActiveForm::end() ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            <?php else : ?>
                <p class="text-center bg-light py-4 fw-light">Список пуст</p>
            <?php endif ?>

            <?php $form = ActiveForm::begin(['action' => "/create-comment/$resume->id"]) ?>
                <div class="mb-3">
                    <?= $form->field($answer_form, 'content')->textarea(['rows' => "12", 'placeholder' => "Оставьте ваши рекомендации по улучшению резюме. Редактор поддерживает маркдаун"])->label(false) ?>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Создать" class="btn btn-primary" data-disable-with="Создать">
                </div>
            <?php ActiveForm::end() ?>

        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->