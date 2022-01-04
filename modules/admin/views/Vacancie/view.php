<?php

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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'status',
        ],
    ]) ?>

</div>
