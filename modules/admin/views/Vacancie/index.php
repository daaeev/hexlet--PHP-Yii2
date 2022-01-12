<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacancieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'level',
            //'money',
            //'type_of_place',
            //'type_of_work',
            //'money_from',
            //'money_to',
            //'currency',
            //'position',
            'city',
            //'address',
            'company',
            //'company_site',
            'contact_name',
            //'contact_number',
            //'contact_email:email',
            //'experience:ntext',
            //'about_company:ntext',
            //'about_project:ntext',
            //'duties:ntext',
            //'requirements:ntext',
            //'conditions:ntext',
            //'technologies:ntext',
            //'pub_date',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>
