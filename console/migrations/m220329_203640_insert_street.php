<?php

use yii\db\Migration;

/**
 * Class m220329_203640_insert_street
 */
class m220329_203640_insert_street extends Migration
{
    public function up()
    {
        $this->insert('street',
            [
                'name' => 'Decanska',
                'municipality_id' =>1
            ]);
        $this->insert('street',
            [
                'name' => 'Rajlovacka',
                'municipality_id' =>2
            ]);
        $this->insert('street',
            [
                'name' => 'Gospodska',
                'municipality_id' =>3
            ]);
    }

    public function down()
    {
        echo "m220329_203640_insert_street cannot be reverted.\n";

        return false;
    }

}
