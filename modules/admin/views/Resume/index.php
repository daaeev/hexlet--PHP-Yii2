<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resumes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            //'english',
            //'github',
            //'contact',
            'description:ntext',
            //'skills:ntext',
            //'achievements:ntext',
            //'pub_date',
            [
                'attribute'=>'author_id',
                'content' => function ($data) {
                    return '<a href="/admin/user/view?id=' . $data->author_id . '">' . $data->author_id . '</a>';
                }
            ],
            //'views',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>
