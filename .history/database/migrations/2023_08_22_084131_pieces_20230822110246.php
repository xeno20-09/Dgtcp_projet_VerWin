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
        
        Schema::create('pieces', function (Blueprint $table) {
            $table->id();
   $table->integer('id_dmd')->default(0);
   $table->foreign('id_dmd')->references('id')->on('Demandes');
   $table->string('nom_d')->nullable();
   $table->string('nom_b')->nullable();
   $table->string('nom_v')->nullable();
   $table->unsignedBigInteger('montantinitial')->default(0);
   $table->foreign('montantinitial')->references('montant')->on('Demandes');


   $table->rememberToken();
   $table->timestamps();
   
        'montantrestant',
        'montantligne',
        'libellepiece',
        'referencespiece',
        'date_piece',
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
