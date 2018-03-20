<?php

namespace app\components;

use Yii;
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
    const MINIMAL_VALUE = 1;
    const MINIMAL_SUM = 2;
    const EXACT_VALUE = 3;
    const EXACT_SUM = 4;

    protected $diceFacesAmount;

    /**
     * DiceHelper constructor.
     * @param int $diceFacesAmount
     */
    public function __construct($diceFacesAmount = 6)
    {
        $this->diceFacesAmount = $diceFacesAmount;
    }

    /**
     * @return array
     */
    public static function getAlgorithmsList()
    {
        return [
            self::MINIMAL_VALUE => Yii::t('app', 'Minimal value'),
            self::MINIMAL_SUM   => Yii::t('app', 'Minimal sum'),
            self::EXACT_VALUE   => Yii::t('app', 'Exact value'),
            self::EXACT_SUM     => Yii::t('app', 'Exact sum'),
        ];
    }

    /**
     * @param int $goalValue
     * @param int $dicesQuantity
     * @param int $algorithm
     *
     * @return int
     */
    public function calculateChances($goalValue, $dicesQuantity, $algorithm)
    {
        $variants = $this->rollDices($dicesQuantity, $this->diceFacesAmount);

        switch ($algorithm) {
            case self::MINIMAL_VALUE:
                return $this->getChancesMinimalValue($variants, $goalValue);
                break;
            case self::MINIMAL_SUM:
                return $this->getChancesMinimalSum($variants, $goalValue);
                break;
            case self::EXACT_VALUE:
                return $this->getChancesExactValue($variants, $goalValue);
                break;
            case self::EXACT_SUM:
                return $this->getChancesExactSum($variants, $goalValue);
                break;
            default:
                return 0;
                break;
        }
    }


    /**
     * @param array[] $variants
     * @param int $minValue
     *
     * @return int
     */
    protected function getChancesMinimalValue($variants, $minValue)
    {
        $counterSuccess = 0;
        foreach ($variants as $variant) {
            foreach ($variant as $dice) {
                if ($dice >= $minValue) {
                    $counterSuccess++;
                    break;
                }
            }
        }

        return $counterSuccess / count($variants);
    }

    /**
     * @param array[] $variants
     * @param int $goalValue
     *
     * @return int
     */
    protected function getChancesMinimalSum($variants, $goalValue)
    {
        $counterSuccess = 0;
        foreach ($variants as $variant) {
            if (array_sum($variant) >= $goalValue) {
                $counterSuccess++;
                break;
            }
        }

        return $counterSuccess / count($variants);
    }

    /**
     * @param array[] $variants
     * @param int $goalValue
     *
     * @return int
     */
    protected function getChancesExactValue($variants, $goalValue)
    {
        $counterSuccess = 0;
        foreach ($variants as $variant) {
            if (in_array($goalValue, $variant)) {
                $counterSuccess++;
            }
        }

        return $counterSuccess / count($variants);
    }

    /**
     * @param array[] $variants
     * @param int $goalValue
     *
     * @return int
     */
    protected function getChancesExactSum($variants, $goalValue)
    {
        $counterSuccess = 0;
        foreach ($variants as $variant) {
            if (array_sum($variant) == $goalValue) {
                $counterSuccess++;
            }
        }

        return $counterSuccess / count($variants);
    }

    protected function rollDices($dicesQuantity, $maxValue)
    {
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

        $variants[] = self::getValues($dices);
        for ($i = 1; $i < $maxCycles; $i++) {
            $dices[0]->nextStep();
            $variants[] = self::getValues($dices);
        }

        return $variants;
    }

    /**
     * @param Dice[] $dices
     * @return array
     */
    protected static function getValues($dices)
    {
        $result = [];
        foreach ($dices as $dice) {
            $result[] = $dice->value;
        }

        return $result;
    }
}