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

            $table->id();$table->id();$table->id();$table->id();

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
