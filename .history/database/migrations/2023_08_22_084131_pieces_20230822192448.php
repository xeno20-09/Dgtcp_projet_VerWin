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
            $table->unsignedBigInteger('id_dmd')->default(0);
            $table->foreign('id_dmd')->references('id')->on('demandes');
            $table->string('nom_d')->nullable();
            $table->string('nom_b')->nullable();
            $table->string('nom_v')->nullable();
            $table->string('libellepiece')->nullable();
            $table->string('referencespiece')->nullable();
            $table->string('date_piece')->nullable();
            $table->string('date_piece')->nullable();
            $table->bigInteger('montantligne')->nullable();
            $table->bigInteger('montantinitial')->nullable();
            $table->bigInteger('montantrestant')->nullable();


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces');
    }
};
