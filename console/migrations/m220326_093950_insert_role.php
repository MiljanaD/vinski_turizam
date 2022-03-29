<?php

use yii\db\Migration;

/**
 * Class m220326_093950_insert_role
 */
class m220326_093950_insert_role extends Migration
{
    /**
     * {@inheritdoc}
     */

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('roles',
            [
                'role' => 'vinar'
            ]);

        $this->insert('roles',
            [
                'role' => 'admin'
            ]);
    }

    public function down()
    {
        echo "m220326_093950_insert_role cannot be reverted.\n";

        return false;
    }

}
