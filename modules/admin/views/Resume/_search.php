<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'english') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'achievements') ?>

    <?php // echo $form->field($model, 'pub_date') ?>

    <?php echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
