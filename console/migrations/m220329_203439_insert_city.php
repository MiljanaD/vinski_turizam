<?php

use yii\db\Migration;

/**
 * Class m220329_203439_insert_city
 */
class m220329_203439_insert_city extends Migration
{
    public function up()
    {
        $this->insert('city',
            [
                'name' => 'Istocno Sarajevo'
            ]);
        $this->insert('city',
            [
                'name' => 'Sarajevo'
            ]);
        $this->insert('city',
            [
                'name' => 'Banja Luka'
            ]);
        $this->insert('city',
            [
                'name' => 'Trebinje'
            ]);
        $this->insert('city',
            [
                'name' => 'Mostar'
            ]);
    }
    public function down()
    {
        echo "m220329_203439_insert_city cannot be reverted.\n";

        return false;
    }
}
