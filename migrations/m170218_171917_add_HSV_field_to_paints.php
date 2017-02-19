<?php

use yii\db\Migration;

class m170218_171917_add_HSV_field_to_paints extends Migration
{
    public function up()
    {
        $this->addColumn('paint', 'hsv_h', $this->float(12));
        $this->addColumn('paint', 'hsv_s', $this->float(12));
        $this->addColumn('paint', 'hsv_v', $this->float(12));
    }

    public function down()
    {
        echo "m170218_171917_add_HSV_field_to_paints cannot be reverted.\n";

        return false;
    }
}
