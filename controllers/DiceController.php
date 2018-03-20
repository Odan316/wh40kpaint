<?php

namespace app\controllers;

use app\models\forms\DiceForm;
use Yii;
use yii\web\Controller;

/**
 * Class DiceController
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 * @since 1.0
 */
class DiceController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new DiceForm();
        if ($model->load(Yii::$app->request->post()) && $model->calculate()) {
            return $this->goBack();
        }
        return $this->render('index',[
            'model' => $model
        ]);
    }

}