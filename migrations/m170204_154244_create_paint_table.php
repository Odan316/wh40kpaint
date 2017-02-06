<?php

use yii\db\Migration;

/**
 * Handles the creation of table `paint`.
 */
class m170204_154244_create_paint_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('paint', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(11)->notNull(),
            'title' => $this->string(32)->notNull(),
            'hex_code' => $this->string(8)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('paint');
    }
}
