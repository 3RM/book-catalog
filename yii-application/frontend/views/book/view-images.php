<?php

use yii\bootstrap\Carousel;

?>
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="row slider-wrap">
                <?php echo Carousel::widget([
                    'items' => $images,
                    'options' => ['data-interval' => 5000],
                    'controls' => [
                        '<span class="" aria-hidden="true"></span>',
                        '<span class="" aria-hidden="true"></span>'
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>