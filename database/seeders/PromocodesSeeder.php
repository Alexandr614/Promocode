<?php

namespace Database\Seeders;

use App\Models\Promocodes;
use Illuminate\Database\Seeder;

class PromocodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promocodes::factory()->count(100000)->create();
    }
}
