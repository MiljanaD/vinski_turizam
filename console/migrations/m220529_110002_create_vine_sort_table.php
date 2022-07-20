<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vine_sort}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%vine_region}}`
 */
class m220529_110002_create_vine_sort_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vine_sort}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'image' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vine_sort}}');
    }
}
