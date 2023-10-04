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
        Schema::create('devise', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_dmd')->references('id')->on('demandes');

            $table->string('devise')->nullable();
            $table->big('valeur')->nullable();
            $table->string('date')->nullable();
            $table->string('dateexpi')->nullable();

/*             $table->string('numero_doss')->nullable();
 */            $table->bigInteger('montantligne')->nullable();
            $table->bigInteger('montantinitial')->nullable();
            $table->bigInteger('montantrestant')->nullable();


            $table->rememberToken();
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devise');
    }
};
