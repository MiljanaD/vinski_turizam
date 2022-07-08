<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%winery}}`
 */
class m220707_204543_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'web_site' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'winery' => $this->integer()->notNull(),
        ]);

        // creates index for column `winery`
        $this->createIndex(
            '{{%idx-contact-winery}}',
            '{{%contact}}',
            'winery'
        );

        // add foreign key for table `{{%winery}}`
        $this->addForeignKey(
            '{{%fk-contact-winery}}',
            '{{%contact}}',
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
        // drops foreign key for table `{{%winery}}`
        $this->dropForeignKey(
            '{{%fk-contact-winery}}',
            '{{%contact}}'
        );

        // drops index for column `winery`
        $this->dropIndex(
            '{{%idx-contact-winery}}',
            '{{%contact}}'
        );

        $this->dropTable('{{%contact}}');
    }
}
