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
        Schema::create('radiologies', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('special_instructions');
            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {    Schema::table("radiologies", function (Blueprint $table) {
        $table->dropForeign("radiologies_consultation_id_foreign"); 
    });
        Schema::dropIfExists('radiologies');
    }
};
