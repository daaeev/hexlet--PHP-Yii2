<?php

use app\components\helpers\UrlGen;
use app\components\helpers\ViewHelper;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\i18n\Formatter;

$this->title = Yii::t('main', 'Вакансии');
?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <?= Alert::widget() ?>
            <h1><?= Yii::t('main', 'Вакансии для разработчиков') ?></h1>

            <div class="p-3 mb-3 bg-light rounded-3">

                <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4',
                        ],
                        'action' => UrlGen::allVacanciesWithFilters(),
                        'method' => 'post',
                    ]) 
                ?>
                    <div class="d-flex flex-column justify-content-start">
                        <?= Html::dropDownList('filters[level]', null, $filters['level'], ['class' => 'form-control']) ?>
                    </div>
                    <div class="d-flex flex-column justify-content-start">
                        <?= Html::input('text', 'filters[city]', null, ['class' => 'form-control', 'placeholder' => Yii::t('main', 'Город')]) ?>
                    </div>
                    <div class="d-flex flex-column justify-content-start">
                        <?= Html::dropDownList('filters[technologies]', null, $filters['technologies'], ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-auto d-flex justify-content-end">
                        <div class="mt-0">
                            <input type="submit" value="<?= Yii::t('main', 'Найти') ?>" class="btn btn-primary me-2" data-disable-with="<?= Yii::t('main', 'Найти') ?>">
                            <a class="btn btn-outline-secondary" href="<?= UrlGen::allVacancies() ?>"><?= Yii::t('main', 'Сбросить') ?></a>
                        </div>
                    </div>
                <?php ActiveForm::end() ?>
                
            </div>

            <div class="mt-5 card-block">
                <?php if ($data['elements']): ?>

                    <!-- CARD -->
                        <?php foreach ($data['elements'] as $vacancie): ?>
                            <div class="card card-noborder border-8 mb-4 p-3 pb-4">
                                <div class="card-info">
                                    <span class="pub-date text-muted me-3 small"><?= (new Formatter)->asRelativeTime($vacancie->pub_date) ?></span>
                                    <h5 class="card-title"><a href="<?= UrlGen::vacancie($vacancie->id) ?>"><?= htmlspecialchars(ViewHelper::createVacancieTitle($vacancie)) ?></a></h5>
                                    <p class="card-tasks mb-1"><?= strip_tags(substr($vacancie->duties, 0, 350)) ?>...</p>
                                    <p class="card-skills fw-bold"><?= htmlspecialchars($vacancie->technologies) ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <!-- CARD -->

                <?php else: ?>
                        <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'Список вакансий пуст') ?></p>
                <?php endif ?>

            </div>

            <?= LinkPager::widget([
                    'pagination' => $data['pagination'],
                    'options' => [
                        'class' => 'd-flex justify-content-center'
                    ]
                ]);
            ?>
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->