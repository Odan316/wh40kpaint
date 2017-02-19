<?php

namespace app\commands;

use app\components\ColorHelper;
use app\models\Paint;
use yii\console\Controller;
use yii\helpers\VarDumper;

/**
 * Class DataController
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class DataController extends Controller
{
    public function actionHsv()
    {
        $paints = Paint::find()->all();
        foreach($paints as $paint){
            $hex = $paint->hex_code;
            if(strpos($paint->hex_code, '#') === false){
                $hex = '#FFFFFF';
            }
            $hsv = ColorHelper::HEXtoHSV($hex);

            VarDumper::dump($hsv);
            $paint->hsv_h = $hsv[0];
            $paint->hsv_s = $hsv[1];
            $paint->hsv_v = $hsv[2];

            $paint->save();
        }
    }
}