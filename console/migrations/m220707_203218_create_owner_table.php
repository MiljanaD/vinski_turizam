<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%owner}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m220707_203218_create_owner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%owner}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string()->defaultValue("fizicko lice"),
        ]);

        $this->createIndex(
            '{{%idx-owner-user_id}}',
            '{{%owner}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-owner-user_id}}',
            '{{%owner}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-owner-user_id}}',
            '{{%owner}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-owner-user_id}}',
            '{{%owner}}'
        );

        $this->dropTable('{{%owner}}');
    }
}
