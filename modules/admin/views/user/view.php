<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (\Yii::$app->user->can('assignment')): ?>
            <?= Html::a('Set role', ['role', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'status',
            'email_confirmed',
            'email:email',
            'password',
            'contribution:ntext',
            'likes_count',
        ],
    ]) ?>

</div>
