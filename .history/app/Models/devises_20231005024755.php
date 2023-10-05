<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devises extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',
        'devise',
        'valeur',

    ];

    public function piece()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


}
