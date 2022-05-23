<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vine_region}}`.
 */
class m220510_193842_create_vine_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vine_region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'GPS_coordinates' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vine_region}}');
    }
}
