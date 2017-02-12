<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Paint]].
 *
 * @see Paint
 */
class PaintQuery extends \yii\db\ActiveQuery
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
        return parent::one($db);
    }
}
