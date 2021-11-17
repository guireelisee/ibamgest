<?php

namespace Database\Seeders;

use App\Models\Salle;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salle::create([
            'nom' => "Salle intec",
            'place' => 30,
            'caracteristique' => "Salle climée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 1 (SC1)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 2 (SC2)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 3 (SC3)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 4 (SC4)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 5 (SC5)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 6 (SC6)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle de cours 7 (SC7)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle informatique 1 (SI1)",
            'place' => 150,
            'caracteristique' => "Salle ventillée",
        ]);

        Salle::create([
            'nom' => "Salle informatique 2 (SI2)",
            'place' => 55,
            'caracteristique' => "Salle climmée",
        ]);

        Salle::create([
            'nom' => "Salle informatique 3 (SI3)",
            'place' => 40,
            'caracteristique' => "Salle climée",
        ]);

        Salle::create([
            'nom' => "Salle ABF1",
            'place' => 100,
            'caracteristique' => "Salle climée",
        ]);

        Salle::create([
            'nom' => "Salle MIAGE 3",
            'place' => 20,
            'caracteristique' => "Salle climée",
        ]);
    }
}
