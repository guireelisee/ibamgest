<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '73916210',
            'role_id' => 1,
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Secretaire',
            'email' => 'secretaire@gmail.com',
            'phone' => '66594866',
            'role_id' => 2,
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Secretaire Permanent',
            'email' => 'sp@gmail.com',
            'phone' => '66594865',
            'role_id' => 3,
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Directeur',
            'email' => 'directeur@gmail.com',
            'phone' => '66594864',
            'role_id' => 4,
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Scolarité',
            'email' => 'scolarite@gmail.com',
            'phone' => '66594863',
            'role_id' => 5,
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ]);
    }
}
