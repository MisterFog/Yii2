<?php

use yii\helpers\Html;
use app\models\User;

Yii::warning(print_r($model, true));
?>

<p>You have entered the following information:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
    <li><label>Phone</label>: <?= Html::encode($model->phone) ?></li>
</ul>