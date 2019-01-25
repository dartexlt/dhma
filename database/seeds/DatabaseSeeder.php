<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('ParameterTableSeeder');

        $this->command->info('Parameter table seeded!');
    }

}
class ParameterTableSeeder extends Seeder {

    public function run()
    {
        DB::table('parameters')->delete();
        DB::table('parameters')->insert(array(
            array('parameter'=>'Q','description'=>'Transferred heat to the network'), //id 1
            array('parameter'=>'h','description'=>'Operation hours'), //id 2
            array('parameter'=>'N','description'=>'Heat capacity'), //id 3
            array('parameter'=>'t','description'=>'Average outdoor temperature'), //id 4
            array('parameter'=>'Q2','description'=>'Consumed heat'), //id 5
            array('parameter'=>'Q3','description'=>'Heat losses'), //id 6
            array('parameter'=>'N3','description'=>'Heat losses capacity'), //id 7
            array('parameter'=>'Qf','description'=>'Fuel (final energy) input to the heating plants and to the cogeneration plants within the considered system within the considered period (usually one year). The amount of this energy is measured at the point of delivery'), //id 8
            array('parameter'=>'Wchp','description'=>'Electricity production of the cogeneration plants of the considered system'), //id 9
            array('parameter'=>'hs','description'=>'Heating season'), //id 10
          ));
    }

}