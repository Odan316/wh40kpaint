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
    public function actionConvertColors()
    {
        $paints = Paint::find()->all();

        foreach($paints as $paint){
            $hex = $paint->hex_code;
            if(strpos($paint->hex_code, '#') === false){
                $hex = '#FFFFFF';
            }
            $rgb = ColorHelper::HEXtoRGB($hex);
            $hsv = ColorHelper::RGBtoHSV($rgb);
            $hsl = ColorHelper::RGBtoHSL($rgb);

            VarDumper::dump($rgb);
            VarDumper::dump($hsv);
            VarDumper::dump($hsl);

            $paint->rgb = $rgb;
            $paint->hsv = $hsv;
            $paint->hsl = $hsl;

            $paint->save();
        }
    }
}