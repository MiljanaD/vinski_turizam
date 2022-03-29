<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%street}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%municipality}}`
 */
class m220329_202136_create_street_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%street}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'municipality_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `municipality_id`
        $this->createIndex(
            '{{%idx-street-municipality_id}}',
            '{{%street}}',
            'municipality_id'
        );

        // add foreign key for table `{{%municipality}}`
        $this->addForeignKey(
            '{{%fk-street-municipality_id}}',
            '{{%street}}',
            'municipality_id',
            '{{%municipality}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%municipality}}`
        $this->dropForeignKey(
            '{{%fk-street-municipality_id}}',
            '{{%street}}'
        );

        // drops index for column `municipality_id`
        $this->dropIndex(
            '{{%idx-street-municipality_id}}',
            '{{%street}}'
        );

        $this->dropTable('{{%street}}');
    }
}
