<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;

$level = [
    'Джуниор' => 'Джуниор',
    'Мидл' => 'Мидл',
    'Сеньор' => 'Сеньор',
    'Тимлид' => 'Тимлид',
];

$money = [
    '' => '',
    'До вычетов' => 'До вычетов',
    'На руки' => 'На руки',
];

$type_of_place = [
    '' => '',
    'Удаленно' => 'Удаленно',
    'В офисе' => 'В офисе',
    'Гибрид' => 'Гибрид',
];

$type_of_work = [
    'Полный день' => 'Полный день',
    'Частичнаяя занятость' => 'Частичнаяя занятость',
    'Контрактная работа' => 'Контрактная работа',
    'Временная работа' => 'Временная работа',
    'Сезонная работа' => 'Сезонная работа',
    'Стажировка' => 'Стажировка',
];

$currencies = [
    '₽' => '₽',
    '₴' => '₴',
    '$' => '$',
    '€' => '€',
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
            <h2 class="h2 mb-4">Новая вакансия</h2>

            <?php $form = ActiveForm::begin() ?>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Уровень <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'level')->dropdownList($level)->label(false) ?>
                            <small class="form-text text-muted">Если в вакансии рассматриваются разные уровни кандидатов, то укажите минимальный</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Сколько денег</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'money')->dropdownList($money)->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Место работы</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'type_of_place')->dropdownList($type_of_place)->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Тип занятости <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'type_of_work')->dropdownList($type_of_work)->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Зарплата от</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'money_from')->input('number', ['step' => 1])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Зарплата до</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'money_to')->input('number', ['step' => 1])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Валюта <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'currency')->dropdownList($currencies)->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Должность <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'position')->input('text')->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Город <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'city')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Один город. Если работа удаленная или офисов много, то укажите город где находится главный офис</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Адрес</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'address')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Улица, дом, офис (без страны и города)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Компания <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'company')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Нужно указывать реальное название компании, по которому соискатели смогут найти информацию и работодателе</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Сайт компании</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'company_site')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Чистый адрес (без меток). Рекомендуется указывать либо ссылку на главную страницу сайта, либо страницу о компании где потенциальный кандидат на должность сможет узнать подробнее в работодателе</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Имя контакта</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'contact_name')->input('text')->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Телефон контакта</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'contact_number')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Поле публичное и индексируемое, видно всем</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Телеграм контакта</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'contact_telegram')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Ссылка на профиль, в формате https://t.me/ваш_логин (например https://t.me/hexlet_ru)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Email контакта</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'contact_email')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Поле публичное и индексируемое, видно всем</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Опыт</label>
                        <div class="col-sm-9">
                        <?= $form->field($model, 'experience')->textarea(['rows' => "10", 'placeholder' => "Редактор поддержиает маркдаун"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">О компании</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'about_company')->textarea(['rows' => "10", 'placeholder' => "Редактор поддержиает маркдаун"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">О проекте</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'about_project')->textarea(['rows' => "10", 'placeholder' => "Редактор поддержиает маркдаун"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Обязанности <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'duties')->textarea(['rows' => "10", 'placeholder' => "Редактор поддержиает маркдаун"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Требования</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'requirements')->textarea(['rows' => "10", 'placeholder' => "Редактор поддержиает маркдаун"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Условия и бонусы</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'conditions')->textarea(['rows' => "10", 'placeholder' => "Редактор поддержиает маркдаун"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Технологии</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'technologies')->input('text')->label(false) ?>
                            <small class="form-text text-muted">Указывать через запятую с пробелом: json, ajax, ...</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm d-flex mb-3">
                        <div class="me-3">
                            <input type="submit" name="commit" value="Создать" class="btn btn-primary" data-disable-with="Создать">
                        </div>
                    </div>
                    <div class="col-sm d-flex justify-content-end mb-3">
                        <a class="btn btn-outline-secondary" href="<?= UrlGen::home() ?>">Cancel</a>
                    </div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<!-- CONTENT -->