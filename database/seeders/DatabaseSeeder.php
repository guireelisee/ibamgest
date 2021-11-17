<?php

namespace Database\Seeders;

use App\Models\Fiche;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FiliereSeeder::class,
            ProfesseurSeeder::class,
            MatiereSeeder::class,
            SalleSeeder::class
        ]);
    }
}
