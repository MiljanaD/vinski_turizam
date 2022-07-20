<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_sort}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%vine_region}}`
 * - `{{%vine_sort}}`
 */
class m220717_213335_create_region_sort_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%region_sort}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'sort_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `region_id`
        $this->createIndex(
            '{{%idx-region_sort-region_id}}',
            '{{%region_sort}}',
            'region_id'
        );

        // add foreign key for table `{{%vine_region}}`
        $this->addForeignKey(
            '{{%fk-region_sort-region_id}}',
            '{{%region_sort}}',
            'region_id',
            '{{%vine_region}}',
            'id',
            'CASCADE'
        );

        // creates index for column `sort_id`
        $this->createIndex(
            '{{%idx-region_sort-sort_id}}',
            '{{%region_sort}}',
            'sort_id'
        );

        // add foreign key for table `{{%vine_sort}}`
        $this->addForeignKey(
            '{{%fk-region_sort-sort_id}}',
            '{{%region_sort}}',
            'sort_id',
            '{{%vine_sort}}',
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
            '{{%fk-region_sort-region_id}}',
            '{{%region_sort}}'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            '{{%idx-region_sort-region_id}}',
            '{{%region_sort}}'
        );

        // drops foreign key for table `{{%vine_sort}}`
        $this->dropForeignKey(
            '{{%fk-region_sort-sort_id}}',
            '{{%region_sort}}'
        );

        // drops index for column `sort_id`
        $this->dropIndex(
            '{{%idx-region_sort-sort_id}}',
            '{{%region_sort}}'
        );

        $this->dropTable('{{%region_sort}}');
    }
}
