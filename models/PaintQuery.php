<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Paint]].
 *
 * @see Paint
 */
class PaintQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
