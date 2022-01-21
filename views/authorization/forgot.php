<?php

use app\components\helpers\UrlGen;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
?>
<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <?= Alert::widget() ?>
        <h2>Забыли пароль?</h2>
        <?php $form = ActiveForm::begin() ?>
            <div class="form-inputs">
                <div class="mb-3">
                    <?= $form->field($model, 'email')->input('email', ['autofocus' => 'autofocus', 'autocomplete' => 'email'])->label('Email *') ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="commit" value="Отправить письмо" class="btn btn-primary" data-disable-with="Отправить письмо">
            </div>
        <?php ActiveForm::end() ?>

        <a href="<?= UrlGen::login() ?>">Авторизоваться</a><br>
        <a rel="nofollow" data-method="post" href="#">Войти с помощью: GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->