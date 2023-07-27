<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name' => 'Headphone',
            'slug_category' => 'headphone'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Headset Gaming',
            'slug_category' => 'headset-gaming'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Speaker',
            'slug_category' => 'speaker'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Microphone',
            'slug_category' => 'microphone'
        ]);
    }
}
