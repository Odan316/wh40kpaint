<?php

namespace app\models\forms;

use app\components\DiceHelper;
use yii\base\Model;

/**
 * DiceForm is the model behind the login form.
 */
class DiceForm extends Model
{
    public $dicesAmount;
    public $goalValue;
    public $algorithm;

    public $result = 0;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dicesAmount', 'goalValue', 'algorithm'], 'required'],
            [['dicesAmount', 'goalValue', 'algorithm'], 'integer'],
            [['algorithm'], 'in', 'range' => array_keys(DiceHelper::getAlgorithmsList())],
        ];
    }


    /**
     */
    public function calculate()
    {
        if ($this->validate()) {
            $this->result = (new DiceHelper())->calculateChances($this->goalValue, $this->dicesAmount, $this->algorithm);
        }
    }
}
