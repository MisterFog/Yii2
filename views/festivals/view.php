<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Festivals */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Festivals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="festivals-view">

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
            'user_id',
            'title_ru',
            'title_en',
            'caption_ru:ntext',
            'caption_en:ntext',
            'content_ru:ntext',
            'content_en:ntext',
            'contacts:ntext',
            'emails:ntext',
            'logo:ntext',
            'brand:ntext',
            'country_id',
            'genre_id',
            'media_photo:ntext',
            'media_video:ntext',
            'files:ntext',
            'start_date',
            'end_date',
            'coord:ntext',
        ],
    ]) ?>

</div>
