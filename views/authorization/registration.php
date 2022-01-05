<?php

use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

?>
<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <h2>Регистрация</h2>
        <?php $form = ActiveForm::begin() ?>
            <div class="form-inputs">
                <div class="mb-3">
                    <?= $form->field($model, 'email')->input('email', ['autofocus' => 'autofocus', 'autocomplete' => 'email'])->label('Email *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password')->input('password', ['autocomplete' => 'current-password'])->label('Пароль *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password_repeat')->input('password', ['autocomplete' => 'current-password'])->label('Подтвердите пароль *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'remember_me')->checkbox(['value' => 1])->label('Запомнить меня') ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" value="Войти" class="btn btn-primary">
            </div>
        <?php ActiveForm::end() ?>

        <a href="<?= Url::to('/login') ?>">Войти</a><br>
        <a href="#">Забыли пароль?</a><br>
        <a rel="nofollow" data-method="post" href="#">Войти с помощью: GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->