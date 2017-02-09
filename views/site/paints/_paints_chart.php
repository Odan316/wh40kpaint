<?php
/**
 * @var $this yii\web\View
 * @var Paint[] $paints
 */
use app\models\Paint;

?>
<div class="row">
    <?php foreach ($paints as $paint) { ?>
        <div class="col-lg-2">
            <div class="paintCard">
                <div class="paintPreview <?= $paint->is_metal ? 'metallic' : ''?>" style="background-color: <?= $paint->hex_code ?>"></div>
                <h4 class="text-center <?= mb_strlen($paint->title) > 17 ? 'long' : ''?>"><?= $paint->title ?></h4>
            </div>
        </div>
    <?php } ?>
</div>