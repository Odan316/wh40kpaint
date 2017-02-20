<?php

namespace app\models;

/**
 * Class HSL
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class HSL
{
    public $h;
    public $s;
    public $l;

    public function __construct($h, $s, $l)
    {
        $this->h = $h;
        $this->s = $s;
        $this->l = $l;
    }

    public function roundValues()
    {
        $this->h = round($this->h);
        $this->s = round($this->s);
        $this->l = round($this->l);
    }
}