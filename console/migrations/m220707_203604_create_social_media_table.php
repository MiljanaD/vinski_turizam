<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social_media}}`.
 */
class m220707_203604_create_social_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_media}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social_media}}');
    }
}
