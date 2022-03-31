<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;
use app\models\User;

$this->title = Yii::t('main', 'Создание вакансии');

$level = [
    'Джуниор' => Yii::t('main', 'Джуниор'),
    'Мидл' => Yii::t('main', 'Мидл'),
    'Сеньор' => Yii::t('main', 'Сеньор'),
    'Тимлид' => Yii::t('main', 'Тимлид'),
];

$money = [
    '' => '',
    'До вычетов' => Yii::t('main', 'До вычетов'),
    'На руки' => Yii::t('main', 'На руки'),
];

$type_of_place = [
    '' => '',
    'Удаленно' => Yii::t('main', 'Удаленно'),
    'В офисе' => Yii::t('main', 'В офисе'),
    'Гибрид' => Yii::t('main', 'Гибрид'),
];

$type_of_work = [
    'Полный день' => Yii::t('main', 'Полный день'),
    'Частичнаяя занятость' => Yii::t('main', 'Частичнаяя занятость'),
    'Контрактная работа' => Yii::t('main', 'Контрактная работа'),
    'Временная работа' => Yii::t('main', 'Временная работа'),
    'Сезонная работа' => Yii::t('main', 'Сезонная работа'),
    'Стажировка' => Yii::t('main', 'Стажировка'),
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
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Уведомления') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои резюме') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои вакансии') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Настройки') ?></a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4"><?= Yii::t('main', 'Новая вакансия') ?></h2>
            
            <?php 
                if (
                    $this->params['user']->status != User::STATUS_BANNED 
                    && $this->params['user']->email_confirmed == User::EMAIL_CONFIRMED
                ): 
            ?>
                <?php $form = ActiveForm::begin() ?>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Уровень') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'level')->dropdownList($level)->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Если в вакансии рассматриваются разные уровни кандидатов, то укажите минимальный') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Выдача зарплаты') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'money')->dropdownList($money)->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Место работы') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'type_of_place')->dropdownList($type_of_place)->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Тип занятости') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'type_of_work')->dropdownList($type_of_work)->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Зарплата от') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'money_from')->input('number', ['step' => 1])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Зарплата до') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'money_to')->input('number', ['step' => 1])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Валюта') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'currency')->dropdownList($currencies)->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Должность') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'position')->input('text')->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Город') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'city')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Один город. Если работа удаленная или офисов много, то укажите город где находится главный офис') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Адрес') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'address')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Улица, дом, офис (без страны и города)') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Компания') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'company')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Нужно указывать реальное название компании, по которому соискатели смогут найти информацию и работодателе') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Сайт компании') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'company_site')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Чистый адрес (без меток). Рекомендуется указывать либо ссылку на главную страницу сайта, либо страницу о компании где потенциальный кандидат на должность сможет узнать подробнее в работодателе') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Имя контакта') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'contact_name')->input('text')->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Телефон контакта') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'contact_number')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Поле публичное и индексируемое, видно всем') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Телеграм контакта') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'contact_telegram')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Ссылка на профиль, в формате https://t.me/ваш_логин (например https://t.me/hexlet_ru)') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Email контакта') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'contact_email')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Поле публичное и индексируемое, видно всем') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Опыт') ?></label>
                            <div class="col-sm-9">
                            <?= $form->field($model, 'experience')->textarea(['rows' => "10", 'placeholder' => Yii::t('main', 'Редактор поддерживает маркдаун')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'О компании') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'about_company')->textarea(['rows' => "10", 'placeholder' => Yii::t('main', 'Редактор поддерживает маркдаун')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'О проекте') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'about_project')->textarea(['rows' => "10", 'placeholder' => Yii::t('main', 'Редактор поддерживает маркдаун')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Обязанности') ?> <span title="обязательно">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'duties')->textarea(['rows' => "10", 'placeholder' => Yii::t('main', 'Редактор поддерживает маркдаун')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Требования') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'requirements')->textarea(['rows' => "10", 'placeholder' => Yii::t('main', 'Редактор поддерживает маркдаун')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Условия и бонусы') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'conditions')->textarea(['rows' => "10", 'placeholder' => Yii::t('main', 'Редактор поддерживает маркдаун')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label class="col-sm-3 col-form-label"><?= Yii::t('main', 'Технологии') ?></label>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'technologies')->input('text')->label(false) ?>
                                <small class="form-text text-muted"><?= Yii::t('main', 'Указывать через запятую с пробелом: json, ajax, ...') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm d-flex mb-3">
                            <div class="me-3">
                                <input type="submit" name="commit" value="<?= Yii::t('main', 'Создать') ?>" class="btn btn-primary" data-disable-with="<?= Yii::t('main', 'Создать') ?>">
                            </div>
                        </div>
                        <div class="col-sm d-flex justify-content-end mb-3">
                            <a class="btn btn-outline-secondary" href="<?= UrlGen::home() ?>"><?= Yii::t('main', 'Отмена') ?></a>
                        </div>
                    </div>
                <?php ActiveForm::end() ?>
            <?php elseif ($this->params['user']->status == User::STATUS_BANNED): ?>
                <p class="text-center bg-light py-4 fw-light">Вы были заблокированы на этом сайте</p>
            <?php elseif ($this->params['user']->email_confirmed == User::EMAIL_NOT_CONFIRMED): ?>
                <p class="text-center bg-light py-4 fw-light"><a href="<?= UrlGen::account('settings') ?>">Подтвердите аккаунт для того, чтобы создавать вакансии</a></p>
            <?php endif ?>

        </div>
    </div>
</div>
<!-- CONTENT -->