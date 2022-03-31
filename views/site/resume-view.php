<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\i18n\Formatter;

$this->title = Yii::t('main', htmlspecialchars($resume->title));
?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <?= Alert::widget() ?>
            <div class="mb-5">
                <div class="d-flex">
                    <h4 class="mb-4 me-3"><?= Yii::t('main', 'Основное') ?></h4>
                    <hr class="my-auto w-100">
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Имя') ?></b></div>
                    <div class="col-sm-9"><a href="<?= UrlGen::profile($resume->author->id) ?>"><?= htmlspecialchars($resume->author->name) ?></a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Описание') ?></b></div>
                    <div class="col-sm-9">
                        <p><?= $resume->description ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Навыки') ?></b></div>
                    <div class="col-sm-9">
                        <p><?= $resume->skills ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><b><?= Yii::t('main', 'Владение английским') ?></b></div>
                    <div class="col-sm-9">
                        <p><?= Yii::t('main', htmlspecialchars($resume->english)) ?></p>
                    </div>
                </div>
                <div class="row mt-3 mb-4">
                    <div class="col-sm-3"><b>Github</b></div>
                    <div class="col-sm-9"><a rel="noopener" href="<?= $resume->github ?>"><?= htmlspecialchars($resume->github) ?></a></div>
                </div>

                <?php if ($resume->contact) : ?>
                    <div class="row mt-3 mb-4">
                        <div class="col-sm-3"><b><?= Yii::t('main', 'Контакт') ?></b></div>
                        <div class="col-sm-9"><?= htmlspecialchars($resume->contact) ?></div>
                    </div>
                <?php endif ?>

                <?php if ($resume->achievements) : ?>
                    <div class="row mt-3 mb-4">
                        <div class="col-sm-3"><b><?= Yii::t('main', 'Достижения') ?></b></div>
                        <div class="col-sm-9"><?= $resume->achievements ?></div>
                    </div>
                <?php endif ?>

                <hr>
            </div>

            <div class="lead mb-3"><?= Yii::t('main', 'Рекомендации') ?></div>

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
                                <a class="text-decoration-none" href="<?= Yii::$app->user->isGuest ? UrlGen::login() : UrlGen::commentLike($comment->id) ?>" data-method='<?= ViewHelper::createDataMethod($comment->id) ?>'>
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

                                <a class="d-block small text-muted" data-bs-toggle="collapse" href="#answer-<?= $comment->id ?>"><?= Yii::t('main', 'Добавить комментарий') ?></a>
                                <div class="collapse" id="answer-<?= $comment->id ?>">
                                    
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Вы не') ?> <a href="<?= UrlGen::login() ?>"><?= Yii::t('main', 'авторизованы') ?></a></p>

                                    <?php 
                                        elseif (
                                            $this->params['user']->status != User::STATUS_BANNED 
                                            && $this->params['user']->email_confirmed == User::EMAIL_CONFIRMED
                                        ): 
                                    ?>
                                        <?php $form = ActiveForm::begin(['action' => UrlGen::createComment($resume->id, $comment->id)]) ?>
                                            <div class="mb-3">
                                                <?= $form->field($comment_form, 'content')->textarea()->label(false) ?>
                                                <small class="form-text text-muted"><?= Yii::t('main', 'Длина не может превышать 200 символов') ?></small>
                                            </div>

                                            <div class="mb-3">
                                                <input type="submit" name="commit" value="<?= Yii::t('main', 'Создать') ?>" class="btn btn-primary" data-disable-with="<?= Yii::t('main', 'Создать') ?>">
                                            </div>
                                        <?php ActiveForm::end() ?>
                                    <?php elseif ($this->params['user']->status == User::STATUS_BANNED): ?>
                                        <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Вы были заблокированы на этом сайте') ?></p>
                                    <?php elseif ($this->params['user']->email_confirmed == User::EMAIL_NOT_CONFIRMED): ?>
                                        <p class="text-center bg-light py-4 fw-light"><a href="<?= UrlGen::account('settings') ?>"><?= Yii::t('main', 'Подтвердите аккаунт для того, чтобы написать комментарий') ?></a></p>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            <?php else : ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Список пуст') ?></p>
            <?php endif ?>

            <?php if (Yii::$app->user->isGuest): ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Вы не') ?> <a href="<?= UrlGen::login() ?>"><?= Yii::t('main', 'авторизованы') ?></a></p>

            <?php 
                elseif (
                    $this->params['user']->status != User::STATUS_BANNED 
                    && $this->params['user']->email_confirmed == User::EMAIL_CONFIRMED
                ): 
            ?>
                <?php $form = ActiveForm::begin(['action' => UrlGen::createComment($resume->id)]) ?>
                    <div class="mb-3">
                        <?= $form->field($answer_form, 'content')->textarea(['rows' => "12", 'placeholder' => Yii::t('main', 'Оставьте ваши рекомендации по улучшению резюме. Редактор поддерживает маркдаун')])->label(false) ?>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="<?= Yii::t('main', 'Создать') ?>" class="btn btn-primary" data-disable-with="<?= Yii::t('main', 'Создать') ?>">
                    </div>
                <?php ActiveForm::end() ?>
            <?php elseif ($this->params['user']->status == User::STATUS_BANNED): ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Вы были заблокированы на этом сайте') ?></p>
            <?php elseif ($this->params['user']->email_confirmed == User::EMAIL_NOT_CONFIRMED): ?>
                <p class="text-center bg-light py-4 fw-light"><a href="<?= UrlGen::account('settings') ?>"><?= Yii::t('main', 'Подтвердите аккаунт для того, чтобы написать свои рекомендации') ?></a></p>
            <?php endif ?>

        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->