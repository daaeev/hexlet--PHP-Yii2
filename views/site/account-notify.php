<?php

use app\components\helpers\UrlGen;
use app\widgets\Alert;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a href="" class="nav-link link-dark active"><?= Yii::t('main', 'Уведомления') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('resume') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои резюме') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('vacancies') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Мои вакансии') ?></a></li>
                <li class="nav-item"><a href="<?= UrlGen::account('settings') ?>" class="nav-link link-dark"><?= Yii::t('main', 'Настройки') ?></a></li>
            </ul>
        </div>
        <div class="col-md-9">

            <?= Alert::widget() ?>

            <h2 class="h2 mb-4"><?= Yii::t('main', 'Уведомления') ?></h2>

            <?php if ($notifications): ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="card mb-3">
                        <p class="card-header fw-bold"><?= htmlspecialchars($notification->title) ?> <a href="<?= UrlGen::deleteNotify($notification->id) ?>"><i class="bi bi-trash"></i></a></p>
                        <div class="card-body">
                            <div class="card-text">
                                <p><?= htmlspecialchars($notification->content) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Список пуст') ?></p>
            <?php endif ?>

        </div>
    </div>
</div>
<!-- CONTENT -->