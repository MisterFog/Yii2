<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use kartik\datetime\DateTimePicker;
use lanselot\parallax\ParallaxWidget;
use newerton\fancybox\FancyBox;
use yii\widgets\Pjax;

//Yii::warning(print_r(date('d M Y'), true));

?>
<div class="entry_page">
    <?= ParallaxWidget::widget([
        'image' => "/images/mercedes.jpg",
        'element' => '.parallax',
        'minHeight' => '400px',
    ]); ?>

    <div class="form">
        <?php $form = ActiveForm::begin(['id' => 'form-telegram']); ?>

        <?= $form->field($model, 'name')->textInput()->hint('Пожалуйста, введите имя')->label('Имя') ?>

        <?= $form->field($model, 'email')->input('email')->hint('Пожалуйста, введите ваш E-mail: mail@mail.ru ')->label('Электронная почта') ?>

        <?= $form->field($model, 'phone')->textInput()->hint('Пожалуйста, введите ваш номер телефона <br> в формате +7 (999) 99 99 999')->label('Номер телефона') ?>

        <div class="form-group">
            <?= Html::submitButton('Entry', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-light trening',
            'style' => 'color: #202060;
                    background: rgb(2,0,36);
                    background: linear-gradient(52deg, rgba(2,0,36,1) 0%, rgba(121,9,94,0.9136029411764706) 35%, rgba(0,212,255,1) 100%);
                    font-size: 16px;
                    font-weight: bold'
        ],
        //'brandLabel' => 'Logo',
        //'brandUrl' => Yii::$app->homeUrl,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-center'],
        'items' => [
            ['label' => 'Festivals', 'url' => ['/festivals']],
            ['label' => 'ToDo', 'url' => ['/todo']],
            ['label' => 'Adminca', 'url' => ['/admin/test']],
        ],
    ]);

    NavBar::end();
    ?>

    <div class="datetimepicker">
        <?php
        echo '<label>Start Date/Time</label>';
        echo DateTimePicker::widget([
            'name' => 'datetime_10',
            'options' => ['placeholder' => 'Select operating time ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'convertFormat' => true,
            //'value' => date('d M Y'),
            'pluginOptions' => [
                'format' => 'dd-M-yyyy h:i',
                'startDate' => '01-01-2019 12:00',
                'todayHighlight' => true,
                'autoclose' => true,
                'language' => 'ru',
            ]
        ]);
        ?>
    </div>

    <div class="divider"></div>

    <h2>Разбераем Pjax</h2>
    <p>Плагин позволяющий легко создавать веб приложения с использованием связки ajax и pushState. Эта технология позволяет после нажатия ссылки или submit на форме, отправить на сервер специальный запрос и получить в ответ только то содержимое, которое необходимо обновить на странице, затем pjax заменяет старое содержимое новым и добавляет в историю браузера и адресную строку актуальную url ссылку, без обновления всей страницы.</p>

    <p>Содержимое, которое нужно обновлять динамически.</p>

    <div>
        <p>Обновление времени с сервера:</p>
        <?php Pjax::begin(); ?>
        <?= Html::a("Обновить", ['site/entry'], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton']) ?>
        <h1>Сейчас: <?= $time ?></h1>

        <?php
        $script = <<< JS
                $(document).ready(function() {
                    setInterval(function(){ $("#refreshButton").click(); }, 60000);
                });
JS;
        $this->registerJs($script);
        ?>
        <?php Pjax::end(); ?>
    </div>


    <p>Несколько независимых блоков:</p>
    <div class="col-sm-12 col-md-6">
        <?php Pjax::begin(); ?>
        <?= Html::a("Новая случайная строка", ['site/entry'], ['class' => 'btn btn-lg btn-primary']) ?>
        <h3><?= $randomString ?></h3>
        <?php Pjax::end(); ?>
    </div>

    <div class="col-sm-12 col-md-6">
        <?php Pjax::begin(); ?>
        <?= Html::a("Новый случайный ключ", ['site/entry'], ['class' => 'btn btn-lg btn-primary']) ?>
        <h3><?= $randomKey ?><h3>
                <?php Pjax::end(); ?>
    </div>


    <p>Использование форм совместно с pjax:</p>
    <?php Pjax::begin(); ?>
    <?= Html::beginForm(['site/entry'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
    <?= Html::submitButton('Получить хеш', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
    <?= Html::endForm() ?>
    <h3><?= $stringHash ?></h3>
    <?php Pjax::end(); ?>

    <div class="container_animate">
        <div class="ball" id="gradient0"></div>
        <div class="ball" id="gradient1"></div>
        <div class="ball" id="gradient2"></div>
        <div class="ball" id="gradient3"></div>
        <div class="ball" id="gradient4"></div>
        <div class="ball" id="gradient5"></div>
        <div class="ball" id="gradient6"></div>
        <div class="ball" id="gradient7"></div>
    </div>

    <div class="divider"></div>

    <div class="flaxybox">
        <h2>Слайдер на основе flaxybox</h2>
        <div class="flaxybox_buttoms">
            <?php
            echo FancyBox::widget([
                'target' => 'a[rel=fancybox]',
                'helpers' => true,
                'mouse' => true,
                'config' => [
                    'maxWidth' => '90%',
                    'maxHeight' => '90%',
                    'playSpeed' => 3000,
                    'padding' => 0,
                    'fitToView' => false,
                    'width' => '70%',
                    'height' => '70%',
                    'autoSize' => false,
                    'closeClick' => false,
                    'openEffect' => 'elastic',
                    'closeEffect' => 'elastic',
                    'prevEffect' => 'elastic',
                    'nextEffect' => 'elastic',
                    'closeBtn' => false,
                    'openOpacity' => true,
                    'helpers' => [
                        'title' => ['type' => 'inside', 'position' => 'bottom'],
                        'buttons' => [],
                        'thumbs' => ['width' => 68, 'height' => 50],
                        'overlay' => [
                            'css' => [
                                'background' => 'rgba(0, 0, 0, 0.8)',
                                'border-radius' => '0'
                            ]
                        ]
                    ],
                ]
            ]);

            echo Html::a(
                Html::img('/images/button.jpg'),
                '/images/flaxybox1.jpg',
                [
                    'rel' => 'fancybox',
                    'title' => 'Антуан Жорж Рошгросс – Античные Воины',
                    'class' => 'preview-item shake shake-slow',
                ]
            );
            echo Html::a(
                Html::img('/images/button.jpg'),
                '/images/flaxybox2.jpg',
                [
                    'rel' => 'fancybox',
                    'title' => 'Карфаген должен быть разрушен!',
                    'class' => 'preview-item shake shake-slow',
                ]
            );
            echo Html::a(
                Html::img('/images/button.jpg'),
                '/images/flaxybox3.jpg',
                [
                    'rel' => 'fancybox',
                    'title' => 'Всё это — 1812 год',
                    'class' => 'preview-item shake shake-slow',
                ]
            );
            ?>
        </div>
    </div>

    <div class="divider"></div>


    <div class="background" id="particles-js"></div>


    <button class="bubbly-button">Click me!</button>


</div>

<?php
/* скрипт для анимационного градиента*/
$script = <<< JS
    
    var colors = new Array(
        [62,35,255],
        [60,255,60],
        [255,35,98],
        [45,175,230],
        [255,0,255],
        [255,128,0]);

    var step = 0;
    /* color table indices for: 
        current color left
        next color left
        current color right
        next color right */
    var colorIndices = [0,1,2,3];

    //transition speed
    var gradientSpeed = 0.002;

    function updateGradient()
    {
        
        if ( $===undefined ) return;
        
        var c0_0 = colors[colorIndices[0]];
        var c0_1 = colors[colorIndices[1]];
        var c1_0 = colors[colorIndices[2]];
        var c1_1 = colors[colorIndices[3]];

        var istep = 1 - step;
        var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
        var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
        var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
        var color1 = "rgb("+r1+","+g1+","+b1+")";

        var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
        var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
        var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
        var color2 = "rgb("+r2+","+g2+","+b2+")";

        for(var i=0;i<=7;i++){
            $('#gradient'+i).css({
                background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
                background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
        }
        
        step += gradientSpeed;

        if ( step >= 1 ){    
            step %= 1;
            colorIndices[0] = colorIndices[1];
            colorIndices[2] = colorIndices[3];
            
            //pick two new target color indices
            //do not pick the same as the current one
            colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
            colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;        
        }
    }

    setInterval(updateGradient,10);
JS;
$this->registerJs($script);

?>

<?php
/* скрипт для анимационного backgrounda*/
$script_b = <<< JS
    particlesJS.load('particles-js', '/assets/js/particles.json', function() {
    console.log('callback - particles_param config loaded');
});
JS;
$this->registerJs($script_b);
?>
<?php
/* скрипт для анимационного backgrounda*/
$this->registerJsFile('/assets/js/particles_param.js');
?>

<?php
/* скрипт для анимационного кнопки*/
$script_btn = <<< JS
    var animateButton = function(e) {
        e.preventDefault;
        //reset animation
        e.target.classList.remove('animate');

        e.target.classList.add('animate');
        setTimeout(function(){
        e.target.classList.remove('animate');
        },1000);
    };

    var bubblyButtons = document.getElementsByClassName("bubbly-button");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateButton, false);
    }
JS;
$this->registerJs($script_btn);
?>