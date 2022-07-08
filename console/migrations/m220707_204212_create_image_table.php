<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%winery}}`
 */
class m220707_204212_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'winary' => $this->integer()->notNull(),
        ]);

        // creates index for column `winary`
        $this->createIndex(
            '{{%idx-image-winary}}',
            '{{%image}}',
            'winary'
        );

        // add foreign key for table `{{%winery}}`
        $this->addForeignKey(
            '{{%fk-image-winary}}',
            '{{%image}}',
            'winary',
            '{{%winery}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%winery}}`
        $this->dropForeignKey(
            '{{%fk-image-winary}}',
            '{{%image}}'
        );

        // drops index for column `winary`
        $this->dropIndex(
            '{{%idx-image-winary}}',
            '{{%image}}'
        );

        $this->dropTable('{{%image}}');
    }
}
