<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paint".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $hex_code
 *
 * @property string $typeName
 */
class Paint extends \yii\db\ActiveRecord
{
    const TYPE_BASE = 10;
    const TYPE_LAYER = 20;
    const TYPE_SHADE = 30;
    const TYPE_DRY = 40;
    const TYPE_GLAZE = 50;
    const TYPE_TEXTURE = 60;
    const TYPE_TECHNICAL = 70;

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
            [ [ 'type', 'title', 'hex_code' ], 'required' ],
            [ [ 'type' ], 'integer' ],
            [ [ 'title' ], 'string', 'max' => 32 ],
            [ [ 'hex_code' ], 'string', 'max' => 8 ],
            [
                'type',
                'in',
                'range' => array_keys(self::getTypes())
            ]
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
            self::TYPE_TECHNICAL => Yii::t('app', 'Technical')
        ];
    }

    public function getTypeName()
    {
        return self::getTypes()[$this->type];
    }

}
