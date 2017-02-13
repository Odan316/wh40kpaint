<?php

/**
 * @var $this yii\web\View
 */

use app\models\Paint;

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <h1 class="text-center">Welcome to interactive color chart</h1>

    <h3 class="text-center">for Games Workshop Citadel Miniatures</h3>

    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->bases()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->layers()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->shades()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->dry()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->glazes()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->edge()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->textures()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->technical()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->sprays()->all() ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => Paint::find()->air()->all() ]) ?>

</div>
