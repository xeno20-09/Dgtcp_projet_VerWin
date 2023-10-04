<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devises extends Model
{
    use HasFactory;
    protected $fillable = [

        'id_dmd',
        /*        'nom_d',
        'nom_b',
        'nom_v', */
        'montantinitial',
        'montantrestant',
        'montantligne',
        'libellepiece',
        'referencespiece',
        'date',
        'dateexpi',
        /*         'numero_doss',
 */
    ];
}
