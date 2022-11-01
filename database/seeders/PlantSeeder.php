<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlantSeeder extends Seeder
{
    /**
     * 
     * Run the database seeds.
     * If one was not using the factory to create data. One could have created data here. 
     * Here it is possible to insert data directly into the database. 
     * From here, i call the plant factory 50 times. Which creates 50 rows of data in the plants table
     *
     * @return void
     */
    public function run()
    {
        Plant::factory()->times(50)->create();
    }
}
