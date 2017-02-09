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
            <div class="paint_preview" style="background-color: <?= $paint->hex_code ?>"></div>
            <h3><?= $paint->title ?></h3>
        </div>
    <?php } ?>
</div>