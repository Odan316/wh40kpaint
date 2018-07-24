<?php

/**
 * @var $this yii\web\View
 * @var $searchModel app\models\search\PaintSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use app\components\ColorHelper;
use app\models\Paint;

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <h1 class="text-center">Interactive color chart</h1>

    <h3 class="text-center">for Games Workshop Citadel Miniatures</h3>

    <?= $this->render('index/_search', [
            'model' => $searchModel
    ]); ?>

    <?= $this->render('index/_paints_chart', [ 'paints' => ColorHelper::sort($dataProvider->getModels()) ]) ?>

    <?php /*foreach (Paint::getTypes() as $typeId => $typeTitle) { ?>
        <?= $this->render('index/_paints_chart', [ 'paints' => ColorHelper::sort(Paint::find()->hasType($typeId)->all()) ]) ?>
    <?php } */?>

</div>
