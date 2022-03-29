<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%municipality}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%city}}`
 */
class m220329_202033_create_municipality_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%municipality}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-municipality-city_id}}',
            '{{%municipality}}',
            'city_id'
        );

        // add foreign key for table `{{%city}}`
        $this->addForeignKey(
            '{{%fk-municipality-city_id}}',
            '{{%municipality}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%city}}`
        $this->dropForeignKey(
            '{{%fk-municipality-city_id}}',
            '{{%municipality}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            '{{%idx-municipality-city_id}}',
            '{{%municipality}}'
        );

        $this->dropTable('{{%municipality}}');
    }

}
