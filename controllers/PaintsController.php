<?php

namespace app\controllers;

use app\models\search\PaintSearch;
use Yii;
use yii\web\Controller;

/**
 * Class PaintsController
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 * @since 1.0
 */
class PaintsController extends Controller
{
    /**
     * Displays paints chart.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PaintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}