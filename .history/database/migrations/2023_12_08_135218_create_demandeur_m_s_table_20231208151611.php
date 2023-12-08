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
        Schema::create('demandeur_m_s', function (Blueprint $table) {
            $table->id();


            $table->string('num_ifu')->nullable();
            $table->string('tel')->nullable();
            $table->string('adresse')->nullable();
            $table->string('boite')->nullable();
            $table->string('nomsociete')->nullable();
            $table->string('email')->nullable();
            $table->string('banque')->nullable();
            $table->string('type_prs')->define('Morale');
            $table->string('categorie')->nullable();
            $table->string('num_compt')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandeur_m_s');
    }
};
