<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use lanselot\parallax\ParallaxWidget;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap" style="background-image: url(/images/otem.jpg); background-size: cover; background-repeat: no-repeat;">
        <canvas class="wrap_background"></canvas>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Training', 'url' => ['/site/entry']],
                ['label' => 'Gii', 'url' => ['/gii']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                [
                    'label' => 'Signup', 'url' => ['/site/signup'],
                    'visible' => Yii::$app->user->isGuest
                ],
                Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ('<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'),

            ],
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>


    <?php
    /* скрипт для анимационного backgrounda*/
    $script_b = <<< JS
                Particles.init({
                    selector: '.wrap_background',
                    color: ['#DA0463', '#ffffff', '#404B69', '#DBEDF3'],
                    maxParticles: 150,// максимальное количество частиц
                    sizeVariations: 4,// количество вариаций размера
                    speed: 0.7,
                    minDistance: 120,// расстояние в px для соединительных линий
                    connectParticles: true,// если соединительные линии должны быть проведены или нет
                    responsive: [
                        {
                            breakpoint: 768,
                            options: {
                                maxParticles: 200,
                                color: '#48F2E3'
                            }
                        },
                        {
                            breakpoint: 480,
                            options: {
                                maxParticles: 120,
                                color: '#48F2E3'
                            }
                        },
                        {
                            breakpoint: 320,
                            options: {
                                maxParticles: 80,
                                color: '#48F2E3'
                            }
                        }]
                });
JS;
    $this->registerJs($script_b);
    ?>
    <?php
    /* скрипт для анимационного backgrounda*/
    $this->registerJsFile('/assets/js/particles.js');
    ?>
</body>

</html>
<?php $this->endPage() ?>