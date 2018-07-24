<?php

namespace app\models;

use app\components\ColorHelper;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "paint".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $hex_code
 * @property boolean $is_metal
 * @property integer $rgb_r
 * @property integer $rgb_g
 * @property integer $rgb_b
 * @property integer $hsv_h
 * @property integer $hsv_s
 * @property integer $hsv_v
 * @property integer $hsl_h
 * @property integer $hsl_s
 * @property integer $hsl_l
 *
 * @property string $tTitle
 * @property string $typeName
 * @property array $rgb
 * @property array $hsv
 * @property array $hsl
 *
 * @see PaintQuery
 */
class Paint extends ActiveRecord
{
    const TYPE_BASE = 10;
    const TYPE_LAYER = 20;
    const TYPE_SHADE = 30;
    const TYPE_DRY = 40;
    const TYPE_GLAZE = 50;
    const TYPE_TEXTURE = 60;
    const TYPE_TECHNICAL = 70;
    const TYPE_EDGE = 80;
    const TYPE_SPRAY = 90;
    const TYPE_AIR = 100;

    const TRANSPARENT = 'transp';

    protected $_rgb = null;
    protected $_hsv = null;
    protected $_hsl = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'title', 'hex_code', 'is_metal'], 'required'],
            [['type'], 'integer'],
            [['title'], 'string', 'max' => 32],
            [['hex_code'], 'string', 'max' => 8],
            [
                'type',
                'in',
                'range' => array_keys(self::getTypes())
            ],
            [['is_metal'], 'boolean'],
            [['is_metal'], 'default', 'value' => false],
            [['rgb_r', 'rgb_g', 'rgb_b'], 'integer'],
            [['hsv_h', 'hsv_s', 'hsv_v'], 'integer'],
            [['hsl_h', 'hsl_s', 'hsl_l'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'       => Yii::t('app', 'ID'),
            'type'     => Yii::t('app', 'Type'),
            'title'    => Yii::t('app', 'Title'),
            'hex_code' => Yii::t('app', 'Hex Code'),
            'is_metal' => Yii::t('app', 'Is Metal'),
        ];
    }

    /**
     * @inheritdoc
     * @return PaintQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaintQuery(get_called_class());
    }

    /**
     * Returns array of paint types as 'id' => 'title'
     *
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_BASE      => Yii::t('app', 'Base'),
            self::TYPE_LAYER     => Yii::t('app', 'Layer'),
            self::TYPE_SHADE     => Yii::t('app', 'Shade'),
            self::TYPE_DRY       => Yii::t('app', 'Dry'),
            self::TYPE_GLAZE     => Yii::t('app', 'Glaze'),
            self::TYPE_TEXTURE   => Yii::t('app', 'Texture'),
            self::TYPE_TECHNICAL => Yii::t('app', 'Technical'),
            self::TYPE_EDGE      => Yii::t('app', 'Edge'),
            self::TYPE_SPRAY     => Yii::t('app', 'Spray'),
            self::TYPE_AIR       => Yii::t('app', 'Air')
        ];
    }

    public static function getColorGroups()
    {
        return [
            ColorHelper::GROUP_RED         => Yii::t('app', 'Red'),
            ColorHelper::GROUP_ORANGE      => Yii::t('app', 'Orange'),
            ColorHelper::GROUP_YELLOW      => Yii::t('app', 'Yellow'),
            ColorHelper::GROUP_LIGHT_GREEN => Yii::t('app', 'Light green'),
            ColorHelper::GROUP_DARK_GREEN  => Yii::t('app', 'Dark green'),
            ColorHelper::GROUP_MARINE      => Yii::t('app', 'Marine'),
            ColorHelper::GROUP_LIGHT_BLUE  => Yii::t('app', 'Light blue'),
            ColorHelper::GROUP_BLUE        => Yii::t('app', 'Blue'),
            ColorHelper::GROUP_DARK_BLUE   => Yii::t('app', 'Dark blue'),
            ColorHelper::GROUP_VIOLET      => Yii::t('app', 'Violet'),
            ColorHelper::GROUP_FUCHSIA     => Yii::t('app', 'Fuchsia'),
            ColorHelper::GROUP_PINK        => Yii::t('app', 'Pink'),
        ];
    }


    /**
     * @return string
     */
    public function getTypeName()
    {
        return isset(self::getTypes()[$this->type])
            ? self::getTypes()[$this->type]
            : Yii::t('app', 'Unknown paint type');
    }

    /**
     * @return RGB
     */
    public function getRGB()
    {
        if ($this->_rgb == null) {
            $this->_rgb = new RGB($this->rgb_r, $this->rgb_b, $this->rgb_g);
        }
        return $this->_rgb;
    }

    /**
     * @param RGB $rgb
     */
    public function setRGB($rgb)
    {
        $this->_rgb = $rgb;

        $this->rgb_r = $rgb->r;
        $this->rgb_g = $rgb->g;
        $this->rgb_b = $rgb->b;
    }

    /**
     * @return HSL
     */
    public function getHSL()
    {
        if ($this->_hsl == null) {
            $this->_hsl = new HSL($this->hsl_h, $this->hsl_s, $this->hsl_l);
        }
        return $this->_hsl;
    }

    /**
     * @param HSL $hsl
     */
    public function setHSL($hsl)
    {
        $this->_hsl = $hsl;

        $this->hsl_h = $hsl->h;
        $this->hsl_s = $hsl->s;
        $this->hsl_l = $hsl->l;
    }

    /**
     * @return HSV
     */
    public function getHSV()
    {
        if ($this->_hsv == null) {
            $this->_hsv = new HSV($this->hsv_h, $this->hsv_s, $this->hsv_v);
        }

        return $this->_hsv;
    }

    /**
     * @param HSV $hsv
     */
    public function setHSV($hsv)
    {
        $this->_hsv = $hsv;

        $this->hsv_h = $hsv->h;
        $this->hsv_s = $hsv->s;
        $this->hsv_v = $hsv->v;
    }

}
