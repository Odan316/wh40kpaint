<?php
/**
 * @var $this yii\web\View
 * @var $model \app\models\forms\DiceForm
 */

use app\components\DiceHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <?= $form->field($model, 'algorithm')->dropDownList(DiceHelper::getAlgorithmsList()) ?>
    </div>
    <div class="col-md-3 col-sm-12">
        <?= $form->field($model, 'goalValue')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3 col-sm-12">
        <?= $form->field($model, 'dicesAmount')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>&nbsp;</label>
            <p><?= Html::submitButton(Yii::t('app', 'GO!'), ['class' => 'btn btn-success']) ?></p>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<h3><?= Yii::t('app', 'Result: {result}%', ['result' => round($model->result*100, 2)]) ?></h3>





