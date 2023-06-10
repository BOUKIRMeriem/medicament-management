<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demande_rdvs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('heure');
            $table->string('statut');
            $table->boolean('valide')->default(false); // Ajoutez la colonne 'valide'
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('medecin_id');
            $table->foreign('medecin_id')->references('id')->on('medecins') ->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("rdvs", function (Blueprint $table) {
            $table->dropForeign(["patient_id"]);
        });
        Schema::table("medecins", function (Blueprint $table) {
            $table->dropForeign(["medecin_id"]);
        });
        Schema::dropIfExists('demande_rdvs');
    }
};
