<?php

namespace app\components;

use yii\helpers\VarDumper;

/**
 * Class DiceHelper
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 * @since 1.0
 */
class DiceHelper
{
    const MIN_VALUE = 1;
    const MAX_VALUE = 6;

    /**
     * @param $dicesQuantity
     * @param $minQuantity
     * @param $maxValue
     * @return int
     */
    public function chances($dicesQuantity, $minQuantity, $maxValue)
    {
        $chances = 0;

        Dice::$min = 1;
        Dice::$max = $maxValue;

        /** @var Dice[] $dices */
        $dices = [];
        $nextDice = null;
        for ($i = ($dicesQuantity - 1); $i >= 0; $i--) {
            $dice = new Dice($nextDice);
            $dices[$i] = $dice;
            $nextDice = $dice;
        }

        $maxCycles = pow($maxValue, $dicesQuantity);

        $variants[] = self::parseDices($dices);
        for($i = 1; $i <= $maxCycles; $i++){
            $dices[0]->nextStep();
            $variants[] = self::parseDices($dices);
        }

        VarDumper::dump($variants, 5, 1);

        return $chances;
    }

    /**
     * @param Dice[] $dices
     * @return string
     */
    private static function parseDices($dices)
    {
        $result = '';
        foreach($dices as $dice){
            $result .= $dice->value;
        }

        return $result;
    }
}