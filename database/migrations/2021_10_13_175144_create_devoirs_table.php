<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevoirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professeur_id')->constrained()->onDelete('cascade');
            $table->foreignId('matiere_id')->constrained()->onDelete('cascade');
            $table->foreignId('filiere_id')->constrained()->onDelete('cascade');
            $table->foreignId('salle_id')->constrained()->onDelete('cascade');
            $table->string('niveau', 100);
            $table->dateTime('date');
            $table->string('duree',20);

            $table->dateTime('date_depot_sujet')->nullable();
            $table->string('sujet_depose_par')->nullable();

            $table->dateTime('date_prise_sujet')->nullable();
            $table->string('sujet_pris_par')->nullable();

            $table->dateTime('date_retour_copie')->nullable();
            $table->string('copie_envoye_par')->nullable();

            $table->dateTime('date_prise_copie_professeur')->nullable();
            $table->string('copie_prise_par')->nullable();

            $table->dateTime('date_retour_copie_apres_correction')->nullable();
            $table->string('copie_retourne_par')->nullable();

            $table->dateTime('date_prise_copie_etudiants')->nullable();
            $table->string('copie_prise_par_etudiant')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devoirs');
    }
}
