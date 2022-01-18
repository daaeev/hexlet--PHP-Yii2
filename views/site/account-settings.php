<?php

use app\components\helpers\UrlGen;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark">Уведомления</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark">Мои резюме</a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark">Мои вакансии</a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4">Настройки</h2>

            <?= Alert::widget() ?>

            <?php $form = ActiveForm::begin() ?>
                <div class="mb-3">
                    <?= $form->field($model, 'user_name')->input('text', ['value' => htmlspecialchars($this->params['user']->name)]) ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'contribution')->textarea(['value' => htmlspecialchars($this->params['user']->contribution)]) ?>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Изменить">
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<!-- CONTENT -->