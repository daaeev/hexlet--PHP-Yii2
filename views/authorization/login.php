<?php

use app\components\helpers\UrlGen;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
?>
<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <?= Alert::widget() ?>
        <h2><?= Yii::t('main', 'Войти') ?></h2>
        <?php $form = ActiveForm::begin() ?>
            <div class="form-inputs">
                <div class="mb-3">
                    <?= $form->field($model, 'email')->input('email', ['autofocus' => 'autofocus', 'autocomplete' => 'email'])->label('Email *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password')->input('password', ['autocomplete' => 'current-password'])->label('Password *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'remember_me')->checkbox(['value' => 1])->label(Yii::t('main', 'Запомнить меня')) ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="commit" value="<?= Yii::t('main', 'Войти') ?>" class="btn btn-primary" data-disable-with="<?= Yii::t('main', 'Войти') ?>">
            </div>
        <?php ActiveForm::end() ?>

        <a href="<?= UrlGen::registration() ?>"><?= Yii::t('main', 'Регистрация') ?></a><br>
        <a href="<?= UrlGen::forgotPassPage() ?>"><?= Yii::t('main', 'Забыли пароль?') ?></a><br>
        <a rel="nofollow" data-method="post" href="#"><?= Yii::t('main', 'Войти с помощью:') ?> GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->