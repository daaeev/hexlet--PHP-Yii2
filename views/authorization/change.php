<?php

use app\components\helpers\UrlGen;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('main', 'Изменение пароля');

?>
<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <h2><?= Yii::t('main', 'Изменение пароля') ?></h2>
        <?php $form = ActiveForm::begin() ?>
            <div class="form-inputs">
                <div class="mb-3">
                    <?= $form->field($model, 'password')->input('password')->label( Yii::t('main', 'Новый пароль') . ' *') ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password_repeat')->input('password')->label( Yii::t('main', 'Подтвердите пароль') ' *') ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="commit" value="<?= Yii::t('main', 'Изменить') ?>" class="btn btn-primary" data-disable-with="<?= Yii::t('main', 'Изменить') ?>">
            </div>
        <?php ActiveForm::end() ?>

        <a href="<?= UrlGen::login() ?>"><?= Yii::t('main', 'Авторизоваться') ?></a><br>
        <a rel="nofollow" data-method="post" href="#"><?= Yii::t('main', 'Войти с помощью:') ?> GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->