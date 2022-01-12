<?php

use app\models\Resume;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Resumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="resume-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (\Yii::$app->user->can('moderation')): ?>
            <?= Html::a('Status Confirm', ['set-status', 'id' => $model->id, 'status' => Resume::STATUS_CONFIRMED], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Status Ban', ['set-status', 'id' => $model->id, 'status' => Resume::STATUS_BANNED], ['class' => 'btn btn-danger']) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',
            'english',
            'github',
            'contact',
            'description:ntext',
            'skills:ntext',
            'achievements:ntext',
            'pub_date',
            [
                'label' => 'author_id',
                'value' => $model->author_id,        
            ],
            'views',
            'status',
        ],
    ]) ?>

</div>
