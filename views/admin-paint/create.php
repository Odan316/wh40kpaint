<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Paint */

$this->title = Yii::t('app', 'Create Paint');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paint-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
