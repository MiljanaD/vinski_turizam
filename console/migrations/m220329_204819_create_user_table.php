<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%roles}}`
 * - `{{%street}}`
 */
class m220329_204819_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'street_number' => $this->integer()->notNull(),
            'role' => $this->integer()->notNull(),
            'street' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'verification_token' => $this->string()->notNull(),
            'activated' => $this->tinyInteger()->notNull()->defaultValue(0),
            'password_reset_token' => $this->string()
        ]);

        // creates index for column `role`
        $this->createIndex(
            '{{%idx-user-role}}',
            '{{%user}}',
            'role'
        );

        // add foreign key for table `{{%roles}}`
        $this->addForeignKey(
            '{{%fk-user-role}}',
            '{{%user}}',
            'role',
            '{{%roles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `street`
        $this->createIndex(
            '{{%idx-user-street}}',
            '{{%user}}',
            'street'
        );

        // add foreign key for table `{{%street}}`
        $this->addForeignKey(
            '{{%fk-user-street}}',
            '{{%user}}',
            'street',
            '{{%street}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // drops foreign key for table `{{%roles}}`
        $this->dropForeignKey(
            '{{%fk-user-role}}',
            '{{%user}}'
        );

        // drops index for column `role`
        $this->dropIndex(
            '{{%idx-user-role}}',
            '{{%user}}'
        );

        // drops foreign key for table `{{%street}}`
        $this->dropForeignKey(
            '{{%fk-user-street}}',
            '{{%user}}'
        );

        // drops index for column `street`
        $this->dropIndex(
            '{{%idx-user-street}}',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
