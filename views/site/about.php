<?php

$this->title = Yii::t('main', 'О проекте');
?>

<div class="container-md mb-5" id="content">
    <div class="row">
        <div class="col-md-9">
            <h1><?= Yii::t('main', 'О проекте'); ?></h1>
            <p><?= Yii::t('main', 'Цель Hexlet CV - предоставить платформу для сообщества, где вы получите рекомендации на резюме от участников сообщества и профессиональных HR.'); ?></p>
            <p><?= Yii::t('main', 'Взаимодействие на Hexlet CV строится на основе резюме и рекомендаций на них. На конкретное резюме каждый участник сообщества дает только одну рекомендацию.'); ?></p>
            <p><?= Yii::t('main', 'Присоединяйтесь к сообществу, публикуйте резюме и оставляйте рекомендации другим участникам. Расскажите о сайте коллегам и друзьям!') ?></p>
            <p><?= Yii::t('main', 'Исходный код платформы Hexlet CV (PHP, Yii2) доступен на GitHub.') ?></p>
            <a target="_blank" rel="noopener" href="https://github.com/daaeev/hexlet--PHP-Yii2"><?= Yii::t('main', 'Исходный код') ?></a>
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>
    </div>
</div>