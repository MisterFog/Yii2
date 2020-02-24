<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Festivals';
$this->params['breadcrumbs'][] = $this->title;

//Yii::warning(print_r('true', true));
?>
<div class="festivals-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Festivals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            'title_ru',
            //'title_en',
            //'caption_ru:ntext',
            [
                'attribute' => 'caption_ru',
                'format' => 'html'
            ],
            //'caption_en:ntext',
            //'content_ru:ntext',
            //'content_en:ntext',
            //'contacts:ntext',
            //'emails:ntext',
            //'logo:ntext',
            //'brand:ntext',
            //'country_id',
            //'genre_id',
            //'media_photo:ntext',
            //'media_video:ntext',
            //'files:ntext',
            //'start_date',
            [
                'attribute' => 'start_date',
                'format' => ['date', 'dd/MM/yyyy']
            ],
            //'end_date',
            [
                'attribute' => 'end_date',
                'format' => ['date', 'dd/MM/yyyy']
            ],
            //'coord:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>