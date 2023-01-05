<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'role' => 'administrator',
            'name' => 'Loker Programmer',
            'email' => 'ikhsanhmr@gmail.com',
            'password' => bcrypt('Admin123'),
        ]);
        User::factory(10)->create([
            'role' => 'jobseeker'
        ]);
        User::factory(10)->create([
            'role' => 'company'
        ]);
    }
}
