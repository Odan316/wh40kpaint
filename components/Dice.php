<?php

namespace app\components;

/**
 * Class Dice
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 * @since 1.0
 */
class Dice
{

    public static $min;
    public static $max;

    public $value;
    /** @var Dice */
    protected $_nextDiceLink;
    protected $_lastDice = false;

    public function  __construct($nextDice)
    {
        if(!empty($nextDice)){
            $this->_nextDiceLink = $nextDice;
        } else {
            $this->_lastDice = true;
        }
        $this->value = self::$min;
    }

    public function nextStep()
    {
        if($this->value === self::$max){
            if($this->_lastDice){
                return 0;
            } else {
                $this->value = self::$min;
                $this->_nextDiceLink->nextStep();
            }
        } else {
            $this->value++;
        }

        return $this->value;
    }
}