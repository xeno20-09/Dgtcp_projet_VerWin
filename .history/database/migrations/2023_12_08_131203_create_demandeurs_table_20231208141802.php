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
        Schema::create('demandeurs', function (Blueprint $table) {
            $table->id();

            $table->string('num_ifu');
            $table->string('profess');
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
                ,
            'tel',
            'banque',
            'num_compt',
            'type_prs',
            'nationalite',
            'categorie',
            'boite',
            'adresse',
            'nomsociete',
            'email'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandeurs');
    }
};
