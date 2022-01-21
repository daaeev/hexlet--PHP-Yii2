<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;

?>
<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <h2>Изменение пароля</h2>
        <?php $form = ActiveForm::begin() ?>
            <div class="form-inputs">
                <div class="mb-3">
                    <?= $form->field($model, 'password')->input('password')->label('Новый пароль *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password_repeat')->input('password')->label('Подтвердите пароль *') ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="commit" value="Изменить" class="btn btn-primary" data-disable-with="Изменить">
            </div>
        <?php ActiveForm::end() ?>

        <a href="<?= UrlGen::login() ?>">Авторизоваться</a><br>
        <a rel="nofollow" data-method="post" href="#">Войти с помощью: GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->