<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PlantSeeder;
use Database\Seeders\ProviderSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * If i have multiple seeder. Here i can seed the database in a specific order. 
     * I seed the tables which don't require elements for other tables first.
     * Or else i will get an error.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProviderSeeder::class);  
    }
}
