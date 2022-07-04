<?php

use yii\db\Migration;

/**
 * Class m220529_110049_insert_vine_sort
 */
class m220529_110049_insert_vine_sort extends Migration
{

    public function up()
    {
        $this->insert('vine_sort',
            [
                'name' => 'Vinska sorta 1',
                'description' =>'Ovo je primjer vinske sorte',
                'vine_region' => 1
            ]);
        $this->insert('vine_sort',
            [
                'name' => 'Vinska sorta 2',
                'description' =>'Ovo je primjer vinske sorte',
                'vine_region' => 1
            ]);
    }

    public function down()
    {
        echo "m220529_110049_insert_vine_sort cannot be reverted.\n";

        return false;
    }

}
