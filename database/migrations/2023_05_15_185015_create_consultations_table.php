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
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id'); 
            $table->date('date_consultation');
            $table->string('type_consultation');
            $table->text('diagnostic');
            $table->unsignedBigInteger('rdv_id');
            $table->foreign('rdv_id')->references('id')->on('rdvs')->onDelete('cascade'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("consultations", function (Blueprint $table) {
            $table->dropForeign("consultations_patient_id_foreign"); 
        });
        Schema::table("consultations", function (Blueprint $table) {
            $table->dropForeign("consultations_medecin_id_foreign"); 
        });
        Schema::dropIfExists('consultations');
    }
};
