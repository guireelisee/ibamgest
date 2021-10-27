<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_arrivee');
            $table->dateTime('date_validation')->nullable();
            $table->string('motif')->nullable();
            $table->string('nom_exp');
            $table->string('prenom_exp');
            $table->string('sp')->nullable();
            $table->string('dir')->nullable();
            $table->string('scolarite')->nullable();
            $table->boolean('accepte')->nullable();
            $table->foreignId('salle_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('fiches');
    }
}
