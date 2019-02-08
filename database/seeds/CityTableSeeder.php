<?php

use App\City;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(['name' => 'Lahore']);
        City::create(['name' => 'Karachi']);
        City::create(['name' => 'Islamabad']);
        City::create(['name' => 'Multan']);
        City::create(['name' => 'Bahawalpur']);
    }
}
