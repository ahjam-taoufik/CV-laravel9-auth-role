<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();
            Role::create(['name' => 'superAdmin']);
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'author']);
            Role::create(['name' => 'user']);
    }
}
