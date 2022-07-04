<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vine_service}}`.
 */
class m220704_202452_create_vine_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vine_service}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vine_service}}');
    }
}
