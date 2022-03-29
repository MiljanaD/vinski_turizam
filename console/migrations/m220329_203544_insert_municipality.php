<?php

use yii\db\Migration;

/**
 * Class m220329_203544_insert_municipality
 */
class m220329_203544_insert_municipality extends Migration
{
    public function up(){
        $this->insert('municipality',
            [
                'name' => 'Istocno Novo Sarajevo',
                'city_id' => 1
            ]);
        $this->insert('municipality',
            [
                'name' => 'Istocna Ilidza',
                'city_id' => 1
            ]);
        $this->insert('municipality',
            [
                'name' => 'Banja Luka',
                'city_id' => 3
            ]);
        $this->insert('municipality',
            [
                'name' => 'Centar',
                'city_id' => 2
            ]);
    }

    public function down()
    {
        echo "m220329_203544_insert_municipality cannot be reverted.\n";

        return false;
    }
}
