<?php

use app\models\Paint;
use app\models\search\PaintSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model PaintSearch
 * @var $action string
 */
?>

<div class="paints-search">
    <h2><?= Yii::t('app/paints', 'Filter') ?></h2>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'type')->dropDownList(Paint::getTypes(), ['prompt' => '']) ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'colorGroup')->dropDownList(Paint::getColorGroups(), ['prompt' => '']) ?>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'isMetallic')->dropDownList([
                1 => Yii::t('app/backend', 'No'),
                2 => Yii::t('app/backend', 'Yes')
            ], [ 'prompt' => '']) ?>
        </div>
        <?= Html::submitButton(Yii::t('app/backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/backend', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


