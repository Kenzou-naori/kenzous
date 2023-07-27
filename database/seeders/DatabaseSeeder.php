<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CouriersSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CreateUserSeeder::class);
        $faker = Faker::create();
        for ($i = 1; $i < 50; $i++) {
            DB::table('products')->insert([

                'product_id' => $faker->firstName,
                'name' => $faker->name,
                'category_id' => $faker->numberBetween(1, 4),
                'slug' => Str::slug($faker->name),
                'image' => 'mk882.png',
                'quantity' => $faker->numberBetween(1, 2000),
                'price' => $faker->numberBetween(100000, 1000000),
                'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
