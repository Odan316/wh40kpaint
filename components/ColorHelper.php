<?php

namespace app\components;

use app\models\HSL;
use app\models\HSV;
use app\models\Paint;
use app\models\RGB;
use yii\helpers\ArrayHelper;

/**
 * Class ColorHelper
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class ColorHelper
{
    /**
     * @param string $hex
     * @return array
     */
    public static function HEXtoHSV($hex)
    {
        $rgb = self::HEXtoRGB($hex);

        return self::RGBtoHSV($rgb);
    }

    /**
     * Converts hex code string to RGB-model
     *
     * @param string $hex
     * @return RGB
     *
     * @link https://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
     */
    public static function HEXtoRGB($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        $rgb = new RGB($r, $g, $b);

        return $rgb; // returns an model with the rgb values
    }

    /**
     * Converts RGB-model to hex code string
     *
     * @param RGB $rgb
     * @return string
     *
     * @link https://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
     */
    public static function RGBtoHEX($rgb)
    {
        $hex = "#";
        $hex .= str_pad(dechex($rgb->r), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->g), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->b), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }

    /**
     * Converts RGB-model to HSV-model
     *
     * @param RGB $rgb
     * @param bool $roundToInteger Will round values to integer after calculations
     * @return HSV
     *
     * @author Unsigned <http://stackoverflow.com/users/629493/unsigned>
     * @link http://stackoverflow.com/a/13887939
     * @copyright Licensed under the terms of the BSD License
     */
    public static function RGBtoHSV($rgb, $roundToInteger = true)    // RGB values:    0-255, 0-255, 0-255
    {                                // HSV values:    0-360, 0-100, 0-100
        // Convert the RGB byte-values to percentages
        $R = ($rgb->r / 255);
        $G = ($rgb->g / 255);
        $B = ($rgb->b / 255);

        // Calculate a few basic values, the maximum value of R,G,B, the
        //   minimum value, and the difference of the two (chroma).
        $maxRGB = max($R, $G, $B);
        $minRGB = min($R, $G, $B);
        $chroma = $maxRGB - $minRGB;

        // Value (also called Brightness) is the easiest component to calculate,
        //   and is simply the highest value among the R,G,B components.
        // We multiply by 100 to turn the decimal into a readable percent value.
        $computedV = 100 * $maxRGB;

        // Special case if hueless (equal parts RGB make black, white, or grays)
        // Note that Hue is technically undefined when chroma is zero, as
        //   attempting to calculate it would cause division by zero (see
        //   below), so most applications simply substitute a Hue of zero.
        // Saturation will always be zero in this case, see below for details.
        if ($chroma == 0) {
            $HSV = new HSV(0, 0, $computedV);
        } else {
            // Saturation is also simple to compute, and is simply the chroma
            //   over the Value (or Brightness)
            // Again, multiplied by 100 to get a percentage.
            $computedS = 100 * ($chroma / $maxRGB);

            // Calculate Hue component
            // Hue is calculated on the "chromacity plane", which is represented
            //   as a 2D hexagon, divided into six 60-degree sectors. We calculate
            //   the bisecting angle as a value 0 <= x < 6, that represents which
            //   portion of which sector the line falls on.
            if ($R == $minRGB) {
                $h = 3 - (($G - $B) / $chroma);
            } elseif ($B == $minRGB) {
                $h = 1 - (($R - $G) / $chroma);
            } else // $G == $minRGB
            {
                $h = 5 - (($B - $R) / $chroma);
            }

            // After we have the sector position, we multiply it by the size of
            //   each sector's arc (60 degrees) to obtain the angle in degrees.
            $computedH = 60 * $h;

            $HSV = new HSV($computedH, $computedS, $computedV);
        }

        if ($roundToInteger) {
            $HSV->roundValues();
        }

        return $HSV;
    }

    /**
     * Converts RGB-model to HSL-model
     *
     * @param RGB $rgb
     * @param bool $roundToInteger Will round values to integer after calculations
     * @return HSL
     *
     * @link https://gist.github.com/brandonheyer/5254516
     */
    public static function RGBtoHSL($rgb, $roundToInteger = true)
    {
        $r = $rgb->r / 255;
        $g = $rgb->g / 255;
        $b = $rgb->b / 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $h = 0;
        $s = 0;
        $l = ($max + $min) / 2;
        $d = $max - $min;
        if ($d == 0) {
            $h = $s = 0; // achromatic
        } else {
            $s = $d / (1 - abs(2 * $l - 1));
            switch ($max) {
                case $r:
                    $h = 60 * fmod((($g - $b) / $d), 6);
                    if ($b > $g) {
                        $h += 360;
                    }
                    break;
                case $g:
                    $h = 60 * (($b - $r) / $d + 2);
                    break;
                case $b:
                    $h = 60 * (($r - $g) / $d + 4);
                    break;
            }
        }
        //$HSL = new HSL( round($h, 2), round($s, 2), round($l, 2) );
        $HSL = new HSL(round($h, 2), round($s * 100, 2), round($l * 100, 2));

        if ($roundToInteger) {
            $HSL->roundValues();
        }

        return $HSL;
    }

    /**
     * Converts HSL-model to RGB-model
     *
     * @param HSL $hsl
     * @return RGB
     *
     * @link https://gist.github.com/brandonheyer/5254516
     */
    public static function HSLtoRGB($hsl)
    {
        $h = $hsl->h;
        $s = $hsl->s;
        $l = $hsl->l;

        $r = 0;
        $g = 0;
        $b = 0;

        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
        $m = $l - ($c / 2);
        if ($h < 60) {
            $r = $c;
            $g = $x;
            $b = 0;
        } else {
            if ($h < 120) {
                $r = $x;
                $g = $c;
                $b = 0;
            } else {
                if ($h < 180) {
                    $r = 0;
                    $g = $c;
                    $b = $x;
                } else {
                    if ($h < 240) {
                        $r = 0;
                        $g = $x;
                        $b = $c;
                    } else {
                        if ($h < 300) {
                            $r = $x;
                            $g = 0;
                            $b = $c;
                        } else {
                            $r = $c;
                            $g = 0;
                            $b = $x;
                        }
                    }
                }
            }
        }
        $r = ($r + $m) * 255;
        $g = ($g + $m) * 255;
        $b = ($b + $m) * 255;

        return new RGB(floor($r), floor($g), floor($b));
    }

    /**
     * @param Paint[] $paints
     *
     * @return Paint[]
     */
    public static function sort($paints)
    {
        $clearPaints = [ ];

        $whitePaints = [ ];
        $blackPaints = [ ];
        $greyPaints = [ ];

        $colourGroups = [
            [ '1', 'red', 0, 15 ],
            [ '2', 'orange', 16, 40 ],
            [ '3', 'yellow', 41, 60 ],
            [ '4', 'light green', 61, 85 ],
            [ '5', 'dark green', 86, 135 ],
            [ '6', 'marine', 136, 180 ],
            [ '7', 'light blue', 181, 200 ],
            [ '8', 'blue', 201, 225 ],
            [ '9', 'dark blue', 226, 250 ],
            [ '10', 'violet', 251, 280 ],
            [ '11', 'fuchsia', 281, 335 ],
            [ '12', 'pink', 336, 345 ],
            [ '13', 'red', 346, 360 ]
        ];

        $colours = [ ];

        foreach ($paints as $paint) {
            if ($paint->hex_code == 'transp') {
                $clearPaints[] = $paint;
            } else {
                if ($paint->hsl_l >= 90) {
                    $whitePaints[] = $paint;
                } elseif ($paint->hsl_l <= 5 OR $paint->hsl_l + $paint->hsl_s < 40 AND $paint->hsl_l <= 20) {
                    $blackPaints[] = $paint;
                } elseif ($paint->hsl_s < 15) {
                    $greyPaints[] = $paint;
                } else {
                    $colourGroup = array_filter($colourGroups, function ($var) use ($paint) {
                        return ($paint->hsl_h >= $var[2] && $paint->hsl_h <= $var[3]);
                    });
                    $colourGroup = array_shift($colourGroup);
                    $colours[$colourGroup[0]][] = $paint;
                }
            }
        }

        // Sort white paints
        self::sortByColour($whitePaints);
        // Sort black paints
        self::sortByColour($blackPaints);
        // Sort grey paints
        self::sortByColour($greyPaints);


        $coloursSorted = [ ];
        ksort($colours);
        foreach ($colours as $group) {
            $coloursSorted = array_merge($coloursSorted, self::sortColorGroup($group));
        }

        return array_merge($clearPaints, $whitePaints, $coloursSorted, $greyPaints, $blackPaints);
    }

    /**
     * @param Paint[] $paints
     *
     * @return Paint[]
     */
    private static function sortColorGroup($paints)
    {
        $bright = [ ];
        $pale = [ ];

        foreach ($paints as $paint) {
            if ($paint->hsl_s > 50) {
                $bright[] = $paint;
            } else {
                $pale[] = $paint;
            }
        }

        self::sortByColour($bright);
        self::sortByColour($pale);

        return array_merge($bright, $pale);
    }

    /**
     * @param Paint[] $paints
     */
    private static function sortByColour(&$paints)
    {
        ArrayHelper::multisort($paints, [ 'hsl_l','hsl_s', 'hsl_h' ], [ SORT_DESC, SORT_DESC, SORT_ASC ]);
    }
}
