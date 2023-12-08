<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandeurM extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_open',
        'num_ifu',
        'tel',
        'banque',
        'num_compt',
        'type_prs',
        'categorie',
        'boite',
        'adresse',
        'nomsociete',
        'email',

    ];
}
