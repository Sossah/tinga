<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('abonnes', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->string('email')->unique();
        $table->string('telephone');
        $table->string('adresse')->nullable();
        $table->string('ville')->nullable();
        $table->string('region')->nullable();
        $table->string('profession')->nullable();
        $table->date('date_naissance')->nullable();
        $table->enum('sexe', ['M', 'F'])->nullable();
        $table->string('numero_piece')->nullable();
        $table->string('type_piece')->nullable();
        $table->timestamps();
    });
  }
    public function down(): void
    {
        Schema::dropIfExists('abonnes');
    }
};
