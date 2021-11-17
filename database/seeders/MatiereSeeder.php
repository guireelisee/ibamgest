<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matiere::create([
            "code_matiere" => "MI001",
            "nom_matiere" => "Windows"
        ]);

        Matiere::create([
            "code_matiere" => "MI002",
            "nom_matiere" => "Unix de base"
        ]);

        Matiere::create([
            "code_matiere" => "MI003",
            "nom_matiere" => "Architecture des ordinateurs"
        ]);

        Matiere::create([
            "code_matiere" => "MI004",
            "nom_matiere" => "Réseau"
        ]);

        Matiere::create([
            "code_matiere" => "MI005",
            "nom_matiere" => "Algèbre général"
        ]);

        Matiere::create([
            "code_matiere" => "MI006",
            "nom_matiere" => "Algèbre linéaire"
        ]);

        Matiere::create([
            "code_matiere" => "MI007",
            "nom_matiere" => "Analyse 1"
        ]);

        Matiere::create([
            "code_matiere" => "MI008",
            "nom_matiere" => "Analyse 2"
        ]);

        Matiere::create([
            "code_matiere" => "MI009",
            "nom_matiere" => "Anglais"
        ]);

        Matiere::create([
            "code_matiere" => "MI0010",
            "nom_matiere" => "Technologies web 1"
        ]);

        Matiere::create([
            "code_matiere" => "MI0011",
            "nom_matiere" => "Technologies web 2"
        ]);

        Matiere::create([
            "code_matiere" => "MI0012",
            "nom_matiere" => "OGE"
        ]);

        Matiere::create([
            "code_matiere" => "MI0013",
            "nom_matiere" => "Comptabilité générale"
        ]);

        Matiere::create([
            "code_matiere" => "MI0014",
            "nom_matiere" => "Comptabilité analytique"
        ]);

        Matiere::create([
            "code_matiere" => "MI0015",
            "nom_matiere" => "Economie des entreprises"
        ]);
    }
}
