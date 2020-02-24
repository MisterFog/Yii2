<?php

/* @var $this yii\web\View */

use dmstr\parallax\widgets\Parallax;
use romkaChev\yii2\swiper\Swiper;
use \lanselot\parallax\ParallaxWidget;

$this->registerJs('initParalax();');

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="jumbotron_h1">Congratulations!</h1>

        <p class="lead">You have successfully created your <b>Yii2</b>-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="slider_wrap">
            <div class="slider_deep">
                <?php
                $items = [];

                $items[] = <<<HTML
                <div class="slider_deep-card col-lg-12">
                    <div class="slider_deep-card_background" style="background-image: url('https://s1.1zoom.ru/prev2/570/Bentley_Mansory_Bentayga_Blue_569846_300x200.jpg');"></div>
                    <div class="slider_deep-card_content">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a>
                    </div>
                </div>
HTML;
                $items[] = <<<HTML
                <div class="slider_deep-card col-lg-12">
                    <div class="slider_deep-card_background" style="background-image: url('https://s1.1zoom.ru/prev2/570/Audi_2019_S5_Sportback_TDI_Worldwide_Light_Blue_569795_300x168.jpg');"></div>
                    <div class="slider_deep-card_content">
                        <h2>Heading</h2>
                        
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a>
                    </div>
                </div>
HTML;
                $items[] = <<<HTML
                <div class="slider_deep-card col-lg-12">
                    <div class="slider_deep-card_background" style="background-image: url('https://s1.1zoom.ru/prev2/570/Audi_2019_A7_Sportback_55_TFSI_e_quattro_S_line_569636_300x212.jpg');"></div>
                    <div class="slider_deep-card_content">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a>
                    </div>
                </div>
HTML;

                echo Swiper::widget([
                    'items' => $items,
                    'pluginOptions' => [
                        'loop' => true,
                        'navigation' => [
                            'nextEl' => '.slider__next',
                            'prevEl' => '.slider__prev'
                        ]
                    ]
                ]);
                ?>

                <div class="slider__prev"></div>
                <div class="slider__next"></div>
            </div>
        </div>
    </div>

    <!-- <h2>ParallaxWidget</h2>
    <?= ParallaxWidget::widget([
        'image' => "/images/mercedes.jpg",
        'element' => '.parallax',
        'minHeight' => '400px',
    ]); ?> -->
</div>

<script>
    function initParalax() {

        $(window).mousemove(function(e) {

            var xpos = e.clientX;
            var ypos = e.clientY;

            $('.jumbotron').css('transform', 'translate(-' + (xpos * 0.04) + 'px, -' + (ypos * 0.02) + 'px)');
            $('.jumbotron_h1').css('transform', 'translate(-' + (xpos * 0.02) + 'px, -' + (ypos * 0.04) + 'px)');
            $('.btn-success').css('transform', 'translate(-' + (xpos * 0.06) + 'px, -' + (ypos * 0.02) + 'px)');

        });
    };
</script>