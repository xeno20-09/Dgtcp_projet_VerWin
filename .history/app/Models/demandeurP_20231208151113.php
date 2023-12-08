<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandeurP extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_birth',
        'nom',
        'num_ifu',
        'prenom',
        'profess',
        'tel',
        'banque',
        'num_compt',
        'type_prs',
        'nationalite',
        'boite',
        'adresse',
        'email',

    ];
}
