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
    protected $fillable = [ ];
    public function piece()
    {
        return $this->belongsTo(demandes::class, 'id_dmd');
    }
    public function n_dmdeur()
    {
        return $this->belongsTo(demandes::class, 'id_dmd');
    } public function n_benef()
    {
        return $this->belongsTo(demandes::class, 'id_dmd');
    } public function n_verifi()
    {
        return $this->belongsTo(demandes::class, 'id_dmd');
    } public function m_ini()
    {
        return $this->belongsTo(demandes::class, 'montantinitial');
    }
}
