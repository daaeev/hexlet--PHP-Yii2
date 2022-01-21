<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;
?>
<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <h2>Войти</h2>
        <?php $form = ActiveForm::begin() ?>
            <div class="form-inputs">
                <div class="mb-3">
                    <?= $form->field($model, 'email')->input('email', ['autofocus' => 'autofocus', 'autocomplete' => 'email'])->label('Email *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password')->input('password', ['autocomplete' => 'current-password'])->label('Пароль *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'remember_me')->checkbox(['value' => 1])->label('Запомнить меня') ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="commit" value="Войти" class="btn btn-primary" data-disable-with="Войти">
            </div>
        <?php ActiveForm::end() ?>

        <a href="<?= UrlGen::registration() ?>">Регистрация</a><br>
        <a href="<?= UrlGen::forgotPassPage() ?>">Забыли пароль?</a><br>
        <a rel="nofollow" data-method="post" href="#">Войти с помощью: GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->