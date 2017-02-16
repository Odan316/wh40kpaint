<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Paints');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paint-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Paint'), [ 'create' ], [ 'class' => 'btn btn-success' ]) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered paintsTable'],
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],
            [
                'attribute' => 'id',
                'headerOptions' => ['class' => 'idColumn']
            ],
            [
                'attribute' => 'type',
                'value'     => function ($model) {
                    return $model->typeName;
                }
            ],
            'title',
            [
                'attribute' => 'hex_code',
                'label' => Yii::t('app', 'Color'),
                'format'    => 'raw',
                'value'     => function ($model) {
                    return "<p class='paintColor' style='background-color: {$model->hex_code}'>&nbsp;</p>";
                }
            ],
            'hex_code',
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
