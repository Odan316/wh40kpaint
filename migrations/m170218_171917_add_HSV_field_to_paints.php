<?php

use yii\db\Migration;

class m170218_171917_add_RGB_HSV_HSL_field_to_paints extends Migration
{
    public function up()
    {
        $this->addColumn('paint', 'rgb_r', $this->smallInteger());
        $this->addColumn('paint', 'rgb_g', $this->smallInteger());
        $this->addColumn('paint', 'rgb_b', $this->smallInteger());

        $this->addColumn('paint', 'hsv_h', $this->smallInteger());
        $this->addColumn('paint', 'hsv_s', $this->smallInteger());
        $this->addColumn('paint', 'hsv_v', $this->smallInteger());

        $this->addColumn('paint', 'hsl_h', $this->smallInteger());
        $this->addColumn('paint', 'hsl_s', $this->smallInteger());
        $this->addColumn('paint', 'hsl_l', $this->smallInteger());
    }

    public function down()
    {
        echo "m170218_171917_add_RGB_HSV_HSL_field_to_paints cannot be reverted.\n";

        return false;
    }
}
