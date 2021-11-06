<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id("idDemande");
            $table->string("nomDemandeur");
            $table->string("prenomDemandeur")->nullable();
            $table->string("tel");
            $table->string("service")->nullable();
            $table->string("profession")->nullable();
            $table->string("motif");
            $table->boolean("decision")->nullable();
            $table->date("date_demande");
            $table->date("date_reponse")->nullable();
            $table->date("date_audience")->nullable();
            $table->time("heure_audience")->nullable();
            $table->bigInteger("id_demandeur")->nullable();

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
        Schema::dropIfExists('demandes');
    }
}
