<?php

/**
 * @var $this yii\web\View
 */

use app\components\ColorHelper;
use app\models\Paint;

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <h1 class="text-center">Welcome to interactive color chart</h1>

    <h3 class="text-center">for Games Workshop Citadel Miniatures</h3>

    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->all()) ]) ?>
<?php /*
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->bases()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->layers()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->shades()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->dry()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->glazes()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->edge()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->textures()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->technical()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->sprays()->byIsMetal()->byColor()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->air()->byIsMetal()->byColor()->all() ]) ?>
*/?>
</div>
