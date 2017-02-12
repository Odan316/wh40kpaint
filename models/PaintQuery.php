<?php

namespace app\models;

use yii\db\ActiveQuery;

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
