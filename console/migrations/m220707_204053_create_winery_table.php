<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%winery}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%street}}`
 * - `{{%owner}}`
 */
class m220707_204053_create_winery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%winery}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'street' => $this->integer(),
            'GPS_coordinates' => $this->string()->notNull(),
            'description' => $this->string(),
            'owner' => $this->integer()->notNull(),
        ]);

        // creates index for column `street`
        $this->createIndex(
            '{{%idx-winery-street}}',
            '{{%winery}}',
            'street'
        );

        // add foreign key for table `{{%street}}`
        $this->addForeignKey(
            '{{%fk-winery-street}}',
            '{{%winery}}',
            'street',
            '{{%street}}',
            'id',
            'CASCADE'
        );

        // creates index for column `owner`
        $this->createIndex(
            '{{%idx-winery-owner}}',
            '{{%winery}}',
            'owner'
        );

        // add foreign key for table `{{%owner}}`
        $this->addForeignKey(
            '{{%fk-winery-owner}}',
            '{{%winery}}',
            'owner',
            '{{%owner}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%street}}`
        $this->dropForeignKey(
            '{{%fk-winery-street}}',
            '{{%winery}}'
        );

        // drops index for column `street`
        $this->dropIndex(
            '{{%idx-winery-street}}',
            '{{%winery}}'
        );

        // drops foreign key for table `{{%owner}}`
        $this->dropForeignKey(
            '{{%fk-winery-owner}}',
            '{{%winery}}'
        );

        // drops index for column `owner`
        $this->dropIndex(
            '{{%idx-winery-owner}}',
            '{{%winery}}'
        );

        $this->dropTable('{{%winery}}');
    }
}
