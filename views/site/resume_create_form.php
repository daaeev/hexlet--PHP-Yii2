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
            <h2 class="h2 mb-4">Новое резюме</h2>

            <form action="" method="">
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Название <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control string" required="required" type="text">
                            <small class="form-text text-muted">PHP-программист, Android-разработчик, ...</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Владение английским <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control string" required="required" type="text">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Hexlet</label>
                        <div class="col-sm-9">
                            <input class="form-control"type="text">
                            <small class="form-text text-muted">Ссылка на профиль: https://ru.hexlet.io/u/mokevnin</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">GitHub <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" required="required" type="text">
                            <small class="form-text text-muted">Ссылка на профиль: https://ru.github.io/u/mokevnin</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Контакт</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text">
                            <small class="form-text text-muted">Предпочитаемый способ связи (емайл, линкендин, телеграмм и т.п.)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Описание <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" required="required" rows="10" placeholder="Редактор поддерживает маркдаун"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Навыки <span title="обязательно">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" required="required" rows="5" placeholder="Редактор поддерживает маркдаун"></textarea>
                            <small class="form-text text-muted">Знаю PHP, пользуюсь Vim, Работал с AWS</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Достижения</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="10" placeholder="Редактор поддерживает маркдаун"></textarea>
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
                            <input type="submit" name="hide" value="В черновик" class="btn btn-outline-primary"  data-disable-with="В черновик">
                        </div>
                    </div>
                    <div class="col-sm d-flex justify-content-end mb-3">
                        <a class="btn btn-outline-secondary" href="#">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CONTENT -->