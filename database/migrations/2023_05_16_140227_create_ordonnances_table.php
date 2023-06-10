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
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medicament');
            $table->date('date');
            $table->string('dosage');
            $table->string('nbr_fois');
            $table->double('qte');
            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    
    {
        Schema::table("ordonnances", function (Blueprint $table) {
            $table->dropForeign("ordonnances_consultation_id_foreign"); 
        });
       
        Schema::dropIfExists('ordonnances');
    }
};
