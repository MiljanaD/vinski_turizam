<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%winery_service}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%winery}}`
 * - `{{%vine_service}}`
 */
class m220717_213828_create_winery_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%winery_service}}', [
            'id' => $this->primaryKey(),
            'winery_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `winery_id`
        $this->createIndex(
            '{{%idx-winery_service-winery_id}}',
            '{{%winery_service}}',
            'winery_id'
        );

        // add foreign key for table `{{%winery}}`
        $this->addForeignKey(
            '{{%fk-winery_service-winery_id}}',
            '{{%winery_service}}',
            'winery_id',
            '{{%winery}}',
            'id',
            'CASCADE'
        );

        // creates index for column `service_id`
        $this->createIndex(
            '{{%idx-winery_service-service_id}}',
            '{{%winery_service}}',
            'service_id'
        );

        // add foreign key for table `{{%vine_service}}`
        $this->addForeignKey(
            '{{%fk-winery_service-service_id}}',
            '{{%winery_service}}',
            'service_id',
            '{{%vine_service}}',
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
            '{{%fk-winery_service-winery_id}}',
            '{{%winery_service}}'
        );

        // drops index for column `winery_id`
        $this->dropIndex(
            '{{%idx-winery_service-winery_id}}',
            '{{%winery_service}}'
        );

        // drops foreign key for table `{{%vine_service}}`
        $this->dropForeignKey(
            '{{%fk-winery_service-service_id}}',
            '{{%winery_service}}'
        );

        // drops index for column `service_id`
        $this->dropIndex(
            '{{%idx-winery_service-service_id}}',
            '{{%winery_service}}'
        );

        $this->dropTable('{{%winery_service}}');
    }
}
