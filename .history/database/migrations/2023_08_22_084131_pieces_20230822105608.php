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
   /*************************Les elements du Damf*********************** */
   $table->unsignedBigInteger('id_damf')->nullable();
   $table->foreign('id_damf')->references('id')->on('Users');
   $table->integer('vu_damf')->default(0);
   $table->integer('reponse_damf')->default(0);
   $table->string('motif')->nullable();
   /*************************Les elements du Damf*********************** */

   $table->rememberToken();
   $table->timestamps();
        'id_dmd',
        'nom_d',
        'nom_b',
        'nom_v',
        'montantinitial',
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
