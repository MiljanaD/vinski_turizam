<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%winery_social_media}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%social_media}}`
 * - `{{%winery}}`
 */
class m220707_204837_create_winery_social_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%winery_social_media}}', [
            'id' => $this->primaryKey(),
            'social_media' => $this->integer()->notNull(),
            'winery' => $this->integer()->notNull(),
        ]);

        // creates index for column `social_media`
        $this->createIndex(
            '{{%idx-winery_social_media-social_media}}',
            '{{%winery_social_media}}',
            'social_media'
        );

        // add foreign key for table `{{%social_media}}`
        $this->addForeignKey(
            '{{%fk-winery_social_media-social_media}}',
            '{{%winery_social_media}}',
            'social_media',
            '{{%social_media}}',
            'id',
            'CASCADE'
        );

        // creates index for column `winery`
        $this->createIndex(
            '{{%idx-winery_social_media-winery}}',
            '{{%winery_social_media}}',
            'winery'
        );

        // add foreign key for table `{{%winery}}`
        $this->addForeignKey(
            '{{%fk-winery_social_media-winery}}',
            '{{%winery_social_media}}',
            'winery',
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
        // drops foreign key for table `{{%social_media}}`
        $this->dropForeignKey(
            '{{%fk-winery_social_media-social_media}}',
            '{{%winery_social_media}}'
        );

        // drops index for column `social_media`
        $this->dropIndex(
            '{{%idx-winery_social_media-social_media}}',
            '{{%winery_social_media}}'
        );

        // drops foreign key for table `{{%winery}}`
        $this->dropForeignKey(
            '{{%fk-winery_social_media-winery}}',
            '{{%winery_social_media}}'
        );

        // drops index for column `winery`
        $this->dropIndex(
            '{{%idx-winery_social_media-winery}}',
            '{{%winery_social_media}}'
        );

        $this->dropTable('{{%winery_social_media}}');
    }
}
