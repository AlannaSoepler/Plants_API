<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\Shop;
use App\Models\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::factory()
        ->times(3)
        ->create();

        foreach(Shop::all() as $shop)
        {
            $plants = Plant::inRandomOrder()->take(rand(1,3))->pluck('id');
            $shop->plants()->attach($plants);
        }
    }
}
