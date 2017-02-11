<?php

use app\models\Paint;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Paint */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paint-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'type',
                'value' => function($model){
                    return $model->typeName;
                }
            ],
            'title',
            [
                'attribute' => 'hex_code',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return "<p class='paintColor' style='background-color: {$model->hex_code}'>&nbsp;</p>";
                }
            ],
            'is_metal:boolean',
        ],
    ]) ?>

</div>
