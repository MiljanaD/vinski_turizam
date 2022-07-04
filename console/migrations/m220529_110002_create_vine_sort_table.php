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
            'vine_region' => $this->integer()->notNull(),
            'image' => $this->string(),
        ]);

        // creates index for column `vine_region`
        $this->createIndex(
            '{{%idx-vine_sort-vine_region}}',
            '{{%vine_sort}}',
            'vine_region'
        );

        // add foreign key for table `{{%vine_region}}`
        $this->addForeignKey(
            '{{%fk-vine_sort-vine_region}}',
            '{{%vine_sort}}',
            'vine_region',
            '{{%vine_region}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%vine_region}}`
        $this->dropForeignKey(
            '{{%fk-vine_sort-vine_region}}',
            '{{%vine_sort}}'
        );

        // drops index for column `vine_region`
        $this->dropIndex(
            '{{%idx-vine_sort-vine_region}}',
            '{{%vine_sort}}'
        );

        $this->dropTable('{{%vine_sort}}');
    }
}
