<?php

namespace app\models;

/**
 * Class HSV
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class HSV
{
    public $h;
    public $s;
    public $v;

    public function __construct($h, $s, $v)
    {
        $this->h = $h;
        $this->s = $s;
        $this->v = $v;
    }

    public function roundValues()
    {
        $this->h = round($this->h);
        $this->s = round($this->s);
        $this->v = round($this->v);
    }
}