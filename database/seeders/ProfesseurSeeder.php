<?php

namespace Database\Seeders;

use App\Models\Professeur;
use Illuminate\Database\Seeder;

class ProfesseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Professeur::create([
            'nom' => "Guinko",
            'prenom' => "Ferdinand",
            'matricule' => "MP001",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "00000000",
            'email' => "exemple1@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Bayili",
            'prenom' => "Gilbert",
            'matricule' => "MP002",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "11111111",
            'email' => "exemple2@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Traoré",
            'prenom' => "Yaya",
            'matricule' => "MP003",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "22222222",
            'email' => "exemple3@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Ouattara",
            'prenom' => "Dimitri",
            'matricule' => "MP004",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "55555555",
            'email' => "exemple4@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Kone",
            'prenom' => "Blaise",
            'matricule' => "MP005",
            'titre' => "Pr",
            'civilite' => "Mr",
            'phone' => "66666666",
            'email' => "exemple5@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Ouédraogo",
            'prenom' => "Désiré",
            'matricule' => "MP006",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "7777777",
            'email' => "exemple6@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Koné",
            'prenom' => "Lydie",
            'matricule' => "MP007",
            'titre' => "-",
            'civilite' => "Mme",
            'phone' => "88888888",
            'email' => "exemple7@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Nassa",
            'prenom' => "Haliguieta",
            'matricule' => "MP008",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "9999999999",
            'email' => "exemple8@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Sawadogo",
            'prenom' => "Emmanuel",
            'matricule' => "MP009",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "10101010",
            'email' => "exemple10@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Sawadogo",
            'prenom' => "Drissa",
            'matricule' => "MP0010",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "111125565",
            'email' => "exemple11@gmail.com",
        ]);

        Professeur::create([
            'nom' => "Kongo",
            'prenom' => "Nelson",
            'matricule' => "MP0011",
            'titre' => "Dr",
            'civilite' => "Mr",
            'phone' => "45254865",
            'email' => "exemple12@gmail.com",
        ]);
    }
}
