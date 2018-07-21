<?php

/**
 * @var $this yii\web\View
 */

use app\components\ColorHelper;
use app\models\Paint;

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <h1 class="text-center">Interactive color chart</h1>

    <h3 class="text-center">for Games Workshop Citadel Miniatures</h3>


    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->bases()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->layers()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->shades()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->dry()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->glazes()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->edge()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->textures()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->technical()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->sprays()->all()) ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->air()->all()) ]) ?>

</div>
