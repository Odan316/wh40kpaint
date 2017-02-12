<?php

/**
 * @var $this yii\web\View
 */

use app\models\Paint;

$this->title = Yii::$app->name;

$paintsBase = Paint::find()->bases()->all();
$paintsLayer = Paint::find()->layers()->all();
$paintsShade = Paint::find()->shades()->all();
$paintsDry = Paint::find()->dry()->all();

?>
<div class="site-index">
    <h1 class="text-center">Welcome to interactive color chart</h1>

    <h3 class="text-center">for Games Workshop Citadel Miniatures</h3>

    <?= $this->render('paints/_paints_chart', [ 'paints' => $paintsBase ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => $paintsLayer ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => $paintsShade ]) ?>
    <?= $this->render('paints/_paints_chart', [ 'paints' => $paintsDry ]) ?>

</div>
