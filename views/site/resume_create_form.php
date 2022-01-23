<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;

$english_levels = [
    'Не знаю' => 'Не знаю',
    'Начальные знания' => 'Начальные знания',
    'Читаю профессиональную литературу' => 'Читаю профессиональную литературу',
    'Могу проходить интервью' => 'Могу проходить интервью',
    'Свободно владею' => 'Свободно владею',
];

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Новое резюме</h2>

            <?php $form = ActiveForm::begin() ?>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Название <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'title')->input('text')->label(false) ?>
                            <small class="form-text text-muted">PHP-программист, Android-разработчик, ...</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Владение английским <span title="обязательно">*</span></label>
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
                            <small class="form-text text-muted">Ссылка на профиль: https://ru.github.io/u/mokevnin</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Контакт</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'contact')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Предпочитаемый способ связи (емайл, линкендин, телеграмм и т.п.)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Описание <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'description')->textarea(['placeholder' => 'Редактор поддерживает маркдаун', 'rows' => 10])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Навыки <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'skills')->textarea(['placeholder' => 'Редактор поддерживает маркдаун', 'rows' => 5])->label(false) ?>
                            <small class="form-text text-muted">Знаю PHP, пользуюсь Vim, Работал с AWS</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Достижения</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'achievements')->textarea(['placeholder' => 'Редактор поддерживает маркдаун', 'rows' => 10])->label(false) ?>
                            <small class="form-text text-muted">Образование, работа, награды, сертификаты, участие в олимпиадах, курсы.</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm d-flex mb-3">
                        <div class="me-3">
                            <input type="submit" name="publish" value="Опубликовать" class="btn btn-success" data-disable-with="Опубликовать">
                        </div>
                        <div class="me-3">
                            <input type="submit" name="draft" value="В черновик" class="btn btn-outline-primary" data-disable-with="В черновик">
                        </div>
                    </div>
                    <div class="col-sm d-flex justify-content-end mb-3">
                        <a class="btn btn-outline-secondary" href="<?= UrlGen::home() ?>">Отмена</a>
                    </div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<!-- CONTENT -->