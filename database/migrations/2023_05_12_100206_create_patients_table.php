<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cin');
            $table->string('nom');
            $table->string('prenom');
            $table->string('date_Naissance');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('adresse_Email');
            $table->string('sexe');
            $table->string('mutuelle')->nullable();
            $table->boolean('archiver')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
