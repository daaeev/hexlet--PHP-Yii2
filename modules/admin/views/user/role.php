<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin() ?>

<?= Html::dropDownList('role', 'user', $roles, ['class' => 'form-control']) ?>

<?= Html::submitButton('Set', [
    'class' => 'btn btn-success mt-4',
    'data' => [
        'confirm' => 'Are you sure?',
    ],
]) 
?>

<?php $form = ActiveForm::end() ?>