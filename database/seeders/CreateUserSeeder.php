<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'Admin@narakenzou.com',
                'no_telp' => '083898979498',
                'address' => 'DI rumah sih',
                'is_admin' => '1',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'user',
                'email' => 'user@narakenzou.com',
                'no_telp' => '083898979498',
                'address' => 'Di rumah sih',
                'is_admin' => '0',
                'password' => bcrypt('12345678'),
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
