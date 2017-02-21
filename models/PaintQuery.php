<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Paint]].
 *
 * @see Paint
 */
class PaintQuery extends ActiveQuery
{
    /**
     * @return PaintQuery
     */
    public function bases()
    {
        return $this->andWhere(['type' => Paint::TYPE_BASE]);
    }

    /**
     * @return PaintQuery
     */
    public function layers()
    {
        return $this->andWhere(['type' => Paint::TYPE_LAYER]);
    }

    /**
     * @return PaintQuery
     */
    public function shades()
    {
        return $this->andWhere(['type' => Paint::TYPE_SHADE]);
    }

    /**
     * @return PaintQuery
     */
    public function dry()
    {
        return $this->andWhere(['type' => Paint::TYPE_DRY]);
    }

    /**
     * @return PaintQuery
     */
    public function glazes()
    {
        return $this->andWhere(['type' => Paint::TYPE_GLAZE]);
    }

    /**
     * @return PaintQuery
     */
    public function textures()
    {
        return $this->andWhere(['type' => Paint::TYPE_TEXTURE]);
    }

    /**
     * @return PaintQuery
     */
    public function technical()
    {
        return $this->andWhere(['type' => Paint::TYPE_TECHNICAL]);
    }

    /**
     * @return PaintQuery
     */
    public function edge()
    {
        return $this->andWhere(['type' => Paint::TYPE_EDGE]);
    }

    /**
     * @return PaintQuery
     */
    public function sprays()
    {
        return $this->andWhere(['type' => Paint::TYPE_SPRAY]);
    }

    /**
     * @return PaintQuery
     */
    public function air()
    {
        return $this->andWhere(['type' => Paint::TYPE_AIR]);
    }

    /**
     * @return PaintQuery
     */
    public function byColor()
    {
        return $this->addSelect('*')
            ->addSelect(new Expression('CASE WHEN hex_code == \'transp\' THEN 1 ELSE 0 END AS is_transp'))
            ->addSelect(new Expression("CASE
                  WHEN hsl_l >= 95
                    THEN 1
                  ELSE
                    CASE WHEN hsl_l <= 5 OR hsl_l + hsl_s < 40 AND hsl_l <= 20
                      THEN 3
                      ELSE 2
                    END
                  END AS lightness_group"))
            ->addSelect(new Expression('CASE WHEN hsl_s < 15 THEN 1 ELSE 0 END AS saturation_group'))
            ->addSelect(new Expression('CAST(hsl_h/30 AS INT) AS color_group'))
            ->addSelect(new Expression('CAST(hsl_h*hsl_h + hsl_s*hsl_s*0.5 + hsl_l*hsl_l*0.25 AS INT) AS color_integral'))
            ->addOrderBy([ 'is_transp'        => SORT_DESC,
                           'lightness_group'  => SORT_ASC,
                           'saturation_group' => SORT_ASC,
                           'color_group'      => SORT_ASC,
                           'color_integral'            => SORT_ASC,
                           /*'hsl_h'            => SORT_ASC,
                           'hsl_s'            => SORT_DESC,
                           'hsl_l'            => SORT_ASC*/
            ]);
    }

    /**
     * @return PaintQuery
     */
    public function byIsMetal()
    {
        return $this->addOrderBy(['is_metal' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     * @return Paint[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Paint|array|null
     */
    public function one($db = null)
    {
        $this->limit(1);
        return parent::one($db);
    }
}
