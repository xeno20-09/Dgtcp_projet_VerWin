<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandeur extends Model
{
    use HasFactory;
    protected $fillable = [
        /*************************Les elements du secretaire*********************** */
        'date_birth',
        'nom',
        'num_ifu',
        'prenom',
        'profess_client',
        'tel_client',
        'banque_client',
        'num_compt_client',
        'type_prs',
        'nationalite',
        'categorie',
        'boite',
        'adresse',
        'nomsociete',
        /*************************Les elements du secretaire*********************** */

        /*************************Les elements du verificateur*********************** */
        'nom_benefi',
        'prenom_benefi',
        'profess_benefi',
        'pays_benifi',
        'banque_benefi',
        'num_compt_benefi',
        'vu_verif',
        'back_verif',
        'pieces',
        'nombre_doc',
        'refpiece',
        'dateexpi',

        /*  'file', */
        'montant_v',
        /*************************Les elements du verificateur*********************** */


        /*************************Les elements du chef_division*********************** */

        'vu_chef_division',
        'back_chef_division',
        'date_decision_chef_division',
        /*************************Les elements du chef_division*********************** */


        /*************************Les elements du chef_bureau*********************** */
        'motif_cb',
        'status_dmd_cb',
        'vu_chef_bureau',
        'back_chef_bureau',
        /*************************Les elements du chef_bureau*********************** */
        /*************************Les elements du Damf*********************** */
        'vu_damf',
        'back_damf',
        'reponse_damf',
        'motif',
        /*************************Les elements du Damf*********************** */

    ];

}
