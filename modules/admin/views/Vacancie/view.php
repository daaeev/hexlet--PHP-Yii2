<?php

use app\models\Vacancie;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancie */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vacancie-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (\Yii::$app->user->can('moderation')): ?>
            <?= Html::a('Status Confirm', ['set-status', 'id' => $model->id, 'status' => Vacancie::STATUS_CONFIRMED], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Status Ban', ['set-status', 'id' => $model->id, 'status' => Vacancie::STATUS_BANNED], ['class' => 'btn btn-danger']) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status',
            'level',
            'money',
            'type_of_place',
            'type_of_work',
            'money_from',
            'money_to',
            'currency',
            'position',
            'city',
            'address',
            'company',
            'company_site',
            'contact_name',
            'contact_number',
            'contact_email:email',
            'experience:ntext',
            'about_company:ntext',
            'about_project:ntext',
            'duties:ntext',
            'requirements:ntext',
            'conditions:ntext',
            'technologies:ntext',
            'pub_date',
        ],
    ]) ?>

</div>
