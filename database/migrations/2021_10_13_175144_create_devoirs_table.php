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

            $table->dateTime('date_depot_sujet')->default(null);
            $table->string('sujet_depose_par')->default(null);

            $table->dateTime('date_prise_sujet');
            $table->string('sujet_pris_par');

            $table->dateTime('date_retour_copie');
            $table->string('copie_envoye_par');

            $table->dateTime('date_prise_copie_professeur');
            $table->string('copie_prise_par');

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
