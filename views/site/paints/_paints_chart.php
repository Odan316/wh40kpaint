<?php
/**
 * @var $this yii\web\View
 * @var Paint[] $paints
 */
use app\models\Paint;

?>
<?php if (count($paints)) { ?>
    <div class="row">
        <h3><?= $paints[0]->typeName ?>&nbsp;(<?= count($paints) ?>)</h3>
        <?php foreach ($paints as $paint) {
            $addClass = '';
            if ($paint->is_metal) {
                $addClass = 'metallic';
            }
            if (in_array($paint->type, [ Paint::TYPE_SHADE, Paint::TYPE_GLAZE ])) {
                $addClass = 'fleck';
            }

            ?>
            <div class="col-lg-2">
                <div class="paintCard">
                    <?php if (!($paint->hex_code == Paint::TRANSPARENT)) { ?>
                        <div class="paintPreview <?= $addClass ?>"
                             style="background-color: <?= $paint->hex_code ?>"></div>
                    <?php } else { ?>
                        <div class="paintPreview <?= $addClass ?>">Clear</div>
                    <?php } ?>
                    <h4 class="text-center <?= mb_strlen($paint->title) > 17 ? 'long' : '' ?>"><?= $paint->title ?></h4>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>