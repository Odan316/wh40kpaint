<?php

namespace app\models;

/**
 * Class RGB
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class RGB
{
    public $r;
    public $g;
    public $b;

    public function __construct($r, $g, $b)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }
}