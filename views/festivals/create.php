<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Festivals */

$this->title = 'Create Festivals';
$this->params['breadcrumbs'][] = ['label' => 'Festivals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="festivals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
