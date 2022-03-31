<?php

use app\components\helpers\UrlGen;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use app\models\User;

$this->title = Yii::t('main', 'Настройки профиля');
?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="<?= UrlGen::account('notify') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Уведомления') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои резюме') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои вакансии') ?></a></li>
                <li class="nav-item"><a href="" class="nav-link link-dark active"><?= Yii::t('main', 'Настройки') ?></a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="h2 mb-4"><?= Yii::t('main', 'Настройки') ?></h2>

            <?= Alert::widget() ?>

            <?php if ($this->params['user']->status != User::STATUS_BANNED): ?>
                <?php $form = ActiveForm::begin() ?>
                    <div class="mb-3">
                        <?= $form->field($model, 'user_name')->input('text', ['value' => htmlspecialchars($this->params['user']->name)]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($model, 'contribution')->textarea(['value' => htmlspecialchars($this->params['user']->contribution)]) ?>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="<?= Yii::t('main', 'Изменить') ?>">
                    </div>
                <?php ActiveForm::end() ?>
            <?php elseif ($this->params['user']->status == User::STATUS_BANNED): ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Вы были заблокированы на этом сайте') ?></p>
            <?php endif ?>

            <hr>
            <div class="account_status my-4">
                <span class="fw-bold"><?= Yii::t('main', 'Статус аккаунта:') ?></span>

                <?php if ($this->params['user']->email_confirmed == User::EMAIL_NOT_CONFIRMED): ?>
                    <span class="text-danger fw-bold"><?= Yii::t('main', 'Не подтверждено') ?></span>
                    <a class="btn btn-primary" href="<?= UrlGen::sendConfirmEmailPage() ?>"><?= Yii::t('main', 'Подтвердить') ?></a>
                <?php else: ?>
                    <span class="text-success fw-bold"><?= Yii::t('main', 'Подтверждено') ?></span>
                <?php endif ?>
                
            </div>
        </div>
    </div>
</div>
<!-- CONTENT -->