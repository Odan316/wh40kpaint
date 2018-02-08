<?php

namespace app\controllers;

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
        return $this->render('index');
    }

}