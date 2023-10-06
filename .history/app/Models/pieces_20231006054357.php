<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pieces extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'id_dmd',
        /*        'nom_d',
        'nom_b',*/
        'nom_v',
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
    public function piece()
    {
        return $this->belongsTo(demandes::class, 'id_dmd');
    }
    /*  public function n_dmdeur()
    {
        return $this->belongsTo(demandes::class, 'nom_d');
    }
    public function n_benef()
    {
        return $this->belongsTo(demandes::class, 'nom_b');
    }
    public function n_verifi()
    {
        return $this->belongsTo(demandes::class, 'nom_v');
    } */
    public function m_ini()
    {
        return $this->belongsTo(demandes::class, 'montantinitial');
    }
}
