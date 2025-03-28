<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('souscriptions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('abonne_id')->constrained()->onDelete('cascade');
        $table->string('numero')->unique();
        $table->decimal('montant', 10, 2)->default('1000');
        $table->string('type_souscription');
        $table->date('date_debut');
        $table->enum('statut', ['en_attente', 'validee', 'rejetee'])->default('en_attente');
        $table->text('commentaire')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('souscriptions');
}
};