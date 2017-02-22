<?php

namespace app\components;

use yii\helpers\ArrayHelper;

/**
 * Class AdvArrayHelper
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class AdvArrayHelper extends ArrayHelper
{
    /**
     * @param string $property
     * @param mixed $value
     * @param array $haystack
     * @return mixed
     */
    public static function findObject($property, $value, $haystack)
    {
        $found = null;
        foreach($haystack as $obj) {
            if ($value == $obj->$property) {
                $found = $obj;
                break;
            }
        }

        return $found;
    }
}