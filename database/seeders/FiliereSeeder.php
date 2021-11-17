<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filiere::create([
            "code_filiere" => "F001",
            "nom_filiere" => "Comptabilité Comtrôle Audit (CCA)"
        ]);

        Filiere::create([
            "code_filiere" => "F002",
            "nom_filiere" => "Assistanat de Direction Bilingue (ADB)"
        ]);

        Filiere::create([
            "code_filiere" => "F003",
            "nom_filiere" => "Assurance Banque Finance (ABF)"
        ]);

        Filiere::create([
            "code_filiere" => "F004",
            "nom_filiere" => "Méthode Informatique Appliquée à la Gestion (MIAGE)"
        ]);

        Filiere::create([
            "code_filiere" => "F005",
            "nom_filiere" => "Markéting et Gestion (MG)"
        ]);
    }
}
