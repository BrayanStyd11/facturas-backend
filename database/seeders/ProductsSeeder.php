<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([            
            'name' => 'Computador Asus VivoBook',
            'description' => 'Computador portatil, procesador Intel Pentium Gold',
            'unit_value' => 1200000,
            'user_id' => 1,
        ]);
    }
}
