<?php

namespace app\components;

use yii\helpers\VarDumper;

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
     * @param string $hex
     * @return array
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
        $rgb = array( $r, $g, $b );
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    /**
     * @param array $rgb
     * @return string
     *
     * @link https://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
     */
    public static function RGBtoHEX($rgb)
    {
        $hex = "#";
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }

    /**
     * Licensed under the terms of the BSD License
     *
     * @param array $rgb
     * @return array
     *
     * @author Unsigned <http://stackoverflow.com/users/629493/unsigned>
     * @link http://stackoverflow.com/a/13887939
     */
    public static function RGBtoHSV($rgb)    // RGB values:    0-255, 0-255, 0-255
    {                                // HSV values:    0-360, 0-100, 0-100
        // Convert the RGB byte-values to percentages
        $R = ($rgb[0] / 255);
        $G = ($rgb[1] / 255);
        $B = ($rgb[2] / 255);

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
            return array( 0, 0, $computedV );
        }

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

        return array( $computedH, $computedS, $computedV );
    }
}
