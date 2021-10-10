<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrateur'
        ]);

        Role::create([
            'name' => 'Directeur'
        ]);

        Role::create([
            'name' => 'Secretaire Permanent'
        ]);

        Role::create([
            'name' => 'Scolarité'
        ]);
    }
}
