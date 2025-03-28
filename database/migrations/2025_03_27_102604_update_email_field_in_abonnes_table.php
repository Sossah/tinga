<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Supprimer d'abord la contrainte d'unicité existante
        Schema::table('abonnes', function (Blueprint $table) {
            $table->dropUnique('abonnes_email_unique');
        });
        
        // Puis modifier la colonne pour la rendre nullable
        Schema::table('abonnes', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });
        
        // Enfin, ajouter à nouveau la contrainte d'unicité
        Schema::table('abonnes', function (Blueprint $table) {
            $table->unique('email');
        });
    }

    public function down()
    {
        Schema::table('abonnes', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
        });
    }
};
