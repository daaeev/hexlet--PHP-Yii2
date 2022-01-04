<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VacancieSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancie-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'money') ?>

    <?= $form->field($model, 'type_of_place') ?>

    <?= $form->field($model, 'type_of_work') ?>

    <?php // echo $form->field($model, 'money_from') ?>

    <?php // echo $form->field($model, 'money_to') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'company_site') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_number') ?>

    <?php // echo $form->field($model, 'contact_email') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'about_company') ?>

    <?php // echo $form->field($model, 'about_project') ?>

    <?php // echo $form->field($model, 'duties') ?>

    <?php // echo $form->field($model, 'requirements') ?>

    <?php // echo $form->field($model, 'conditions') ?>

    <?php // echo $form->field($model, 'technologies') ?>

    <?php // echo $form->field($model, 'pub_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
