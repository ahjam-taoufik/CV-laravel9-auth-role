<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
       
                    $admin=User::create([
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
                    ]);

                    $author=User::create([
                    'name' => 'author',
                    'email' => 'author@author.com',
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
                    ]);

                    $user=User::create([
                    'name' => 'user',
                    'email' => 'user@user.com',
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
                    ]);

                    $admin->roles()->attach(Role::where('name', 'admin')->first());
                    $author->roles()->attach(Role::where('name', 'author')->first());
                    $user->roles()->attach(Role::where('name', 'user')->first());
    }
}
