<?php

use yii\helpers\Url;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= Url::to('/account/notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/resume') ?>" class="nav-link link-dark">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/vacancies') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="<?= Url::to('/account/settings') ?>" class="nav-link link-dark">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Новая вакансия</h2>

            <form action="" method="">
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Уровень <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select required" required="required" aria-required="true">
                                <option selected="selected" value="junior">Джуниор</option>
                                <option value="middle">Мидл</option>
                                <option value="senior">Синьор</option>
                            </select>
                            <small class="form-text text-muted">Если в вакансии рассматриваются разные уровни кандидатов, то укажите минимальный</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Сколько денег</label>
                        <div class="col-sm-9">
                            <select class="form-control select">
                                <option selected="selected" value="junior">До вычетов</option>
                                <option value="middle">На руки</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Место работы</label>
                        <div class="col-sm-9">
                            <select class="form-control select">
                                <option selected="selected" value="junior">Удаленно</option>
                                <option value="middle">В офисе</option>
                                <option value="middle">Гибрид</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Тип занятости <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select" required="required" aria-required="true">
                                <option selected="selected" value="full-time">Полный день</option>
                                <option value="part-time">Частичная занятость</option>
                                <option value="contract">Контрактная работа</option>
                                <option value="temporary">Временная работа</option>
                                <option value="seasonal">Сезонная работа</option>
                                <option value="internship">Стажировка</option></select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Зарплата от</label>
                        <div class="col-sm-9">
                            <input type="number" step="1" class="form-control numeric optional">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Зарплата до</label>
                        <div class="col-sm-9">
                            <input type="number" step="1" class="form-control numeric optional">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Валюта <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select" required="required" aria-required="true">
                                <option selected="selected" value="full-time">₽</option>
                                <option selected="selected" value="full-time">₴</option>
                                <option value="part-time">$</option>
                                <option value="contract">€</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Должность <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control string" required="required" aria-required="true" type="text">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Город <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control string" required="required" aria-required="true" type="text">
                            <small class="form-text text-muted">Один город. Если работа удаленная или офисов много, то укажите город где находится главный офис</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Адрес</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">Улица, дом, офис (без страны и города)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Компания <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text" required="required" aria-required="true">
                            <small class="form-text text-muted">Нужно указывать реальное название компании, по которому соискатели смогут найти информацию и работодателе</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Сайт компании</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">Чистый адрес (без меток). Рекомендуется указывать либо ссылку на главную страницу сайта, либо страницу о компании где потенциальный кандидат на должность сможет узнать подробнее в работодателе</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Имя контакта</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Телефон контакта</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">Поле публичное и индексируемое, видно всем</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Телеграм контакта</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">Ссылка на профиль, в формате https://t.me/ваш_логин (например https://t.me/hexlet_ru)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email контакта</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">Поле публичное и индексируемое, видно всем</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Опыт</label>
                        <div class="col-sm-9">
                            <textarea class="form-control string" rows="10" placeholder="Редактор поддержиает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">О компании</label>
                        <div class="col-sm-9">
                            <textarea class="form-control string" rows="10" placeholder="Редактор поддержиает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">О проекте</label>
                        <div class="col-sm-9">
                            <textarea class="form-control string" rows="10" placeholder="Редактор поддержиает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Обязанности <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control string" rows="10" required="required" aria-required="true" placeholder="Редактор поддержиает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Требования</label>
                        <div class="col-sm-9">
                            <textarea class="form-control string" rows="10" placeholder="Редактор поддержиает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Условия и бонусы</label>
                        <div class="col-sm-9">
                            <textarea class="form-control string" rows="10" placeholder="Редактор поддержиает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Технологии</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">То что указывают компании: json, ajax, ...</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Направления</label>
                        <div class="col-sm-9">
                            <input class="form-control string" type="text">
                            <small class="form-text text-muted">Полный стек технологий лучше указать в описании. Это поле тегов для того, чтобы ваши вакансии быстрее находили потенциальные соискатели. Здесь нужно указывать только то, про что можно сказать X-разработчик, например: android, ios, php, js, java и тд</small>
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
                        <a class="btn btn-outline-secondary" href="#">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CONTENT -->