<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;
use app\models\User;

$this->title = Yii::t('main', 'Создание резюме');

$english_levels = [
    'Не знаю' => Yii::t('main','Не знаю'),
    'Начальные знания' => Yii::t('main','Начальные знания'),
    'Читаю профессиональную литературу' => Yii::t('main','Читаю профессиональную литературу'),
    'Могу проходить интервью' => Yii::t('main','Могу проходить интервью'),
    'Свободно владею' => Yii::t('main','Свободно владею'),
];

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Уведомления') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои резюме') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои вакансии') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Настройки') ?></a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4"><?= Yii::t('main', 'Новое резюме') ?></h2>

            <?php 
                if (
                    $this->params['user']->status != User::STATUS_BANNED 
                    && $this->params['user']->email_confirmed == User::EMAIL_CONFIRMED
                ): 
            ?>
                <?php $form = ActiveForm::begin() ?>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Должность') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'title')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'PHP-программист, Android-разработчик') ?>, ...</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Владение английским') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'english')->dropdownList($english_levels)->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">GitHub <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'github')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Ссылка на профиль:') ?> https://ru.github.io/u/mokevnin</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Контакт') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'contact')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Предпочитаемый способ связи (емайл, линкендин, телеграмм и т.п.)') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Описание') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'description')->textarea(['placeholder' => Yii::t('main','Редактор поддерживает маркдаун'), 'rows' => 10])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Навыки') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'skills')->textarea(['placeholder' => Yii::t('main','Редактор поддерживает маркдаун'), 'rows' => 5])->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Знаю PHP, пользуюсь Vim, Работал с AWS') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Достижения') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'achievements')->textarea(['placeholder' => Yii::t('main','Редактор поддерживает маркдаун'), 'rows' => 10])->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', '') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm d-flex mb-3">
                            <div class="me-3">
                                <input type="submit" name="publish" value="<?= Yii::t('main', 'Опубликовать') ?>" class="btn btn-success" data-disable-with="<?= Yii::t('main', 'Опубликовать') ?>">
                            </div>
                            <div class="me-3">
                                <input type="submit" name="draft" value="<?= Yii::t('main', 'В черновик') ?>" class="btn btn-outline-primary" data-disable-with="<?= Yii::t('main', 'В черновик') ?>">
                            </div>
                        </div>
                        <div class="col-sm d-flex justify-content-end mb-3">
                            <a class="btn btn-outline-secondary" href="<?= UrlGen::home() ?>"><?= Yii::t('main', 'Отмена') ?></a>
                        </div>
                    </div>
                <?php ActiveForm::end() ?>
            <?php elseif ($this->params['user']->status == User::STATUS_BANNED): ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Вы были заблокированы на этом сайте') ?></p>
            <?php elseif ($this->params['user']->email_confirmed == User::EMAIL_NOT_CONFIRMED): ?>
                <p class="text-center bg-light py-4 fw-light"><a href="<?= UrlGen::account('settings') ?>"><?= Yii::t('main', 'Подтвердите аккаунт для того, чтобы создавать резюме') ?></a></p>
            <?php endif ?>

        </div>
    </div>
</div>
<!-- CONTENT -->