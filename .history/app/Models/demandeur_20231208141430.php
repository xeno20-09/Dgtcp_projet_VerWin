<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandeur extends Model
{
    use HasFactory;
    protected $fillable = [
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

    ];
}
