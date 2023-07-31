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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();


            /*************************Les elements du secretaire*********************** */
            $table->string('numero_doss')->default('XX0000');
            $table->date('date')->nullable();
            $table->string('nature_p')->nullable();
            $table->string('nature_op')->nullable();
            $table->('montant')->nullable();
            $table->('montant_con')->default(0.0);
            $table->string('devise')->nullable();
            $table->string('nom_client')->nullable();
            $table->string('prenom_client')->nullable();
            $table->string('profess_client')->nullable();
            $table->string('tel_client')->nullable();
            $table->string('banque_client')->nullable();
            $table->string('num_compt_client')->nullable();
            $table->unsignedBigInteger('id_secret')->nullable();
            $table->foreign('id_secret')->references('id')->on('Users');
            $table->string('status_dmd')->nullable();
            $table->integer('vu_secret')->default(0);
            /*************************Les elements du secretaire*********************** */


            /*************************Les elements du verificateur*********************** */
            $table->string('nom_benefi')->nullable();
            $table->string('prenom_benefi')->nullable();
            $table->string('profess_benefi')->nullable();
            $table->string('pays_benifi')->nullable();
            $table->string('banque_benefi')->nullable();
            $table->string('num_compt_benefi')->nullable();
            $table->unsignedBigInteger('id_verifi')->nullable();
            $table->foreign('id_verifi')->references('id')->on('Users');
            $table->integer('vu_verifi')->default(0);
            /*************************Les elements du verificateur*********************** */



            /*************************Les elements du chef_bureau*********************** */
            $table->unsignedBigInteger('id_chef_bureau')->nullable();
            $table->integer('visa_chef_bureau')->default(0);
            $table->foreign('id_chef_bureau')->references('id')->on('Users');
            $table->integer('vu_chef_bureau')->default(0);
            /*************************Les elements du chef_bureau*********************** */


            /*************************Les elements du chef_division*********************** */
            $table->unsignedBigInteger('id_chef_division')->nullable();
            $table->date('date_decision')->nullable();
            $table->foreign('id_chef_division')->references('id')->on('Users');
            $table->integer('vu_chef_division')->default(0);
            /*************************Les elements du chef_division*********************** */


            /*************************Les elements du Damf*********************** */
            $table->unsignedBigInteger('id_damf')->nullable();
            $table->foreign('id_damf')->references('id')->on('Users');
            $table->integer('vu_damf')->default(0);
            $table->integer('reponse_damf')->default(0);
            $table->string('motif')->nullable();
            /*************************Les elements du Damf*********************** */

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
