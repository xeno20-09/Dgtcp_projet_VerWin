<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        /*************************Les elements du secretaire*********************** */
        'numero_doss',
        'date',
        'nature_p',
        'nature_op',
        'montant',
        'montant_con',
        'devise',
        'nom_client',
        'prenom_client',
        'profess_client',
        'tel_client',
        'banque_client',
        'num_compt_client',
        'vu_secret',
        'back_secret',
        'status_dmd',
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

    public function dmd_secret()
    {
        return $this->belongsTo(User::class, 'id_secret');
    }
    public function dmd_verifi()
    {
        return $this->belongsTo(User::class, 'id_verifi');
    }
    public function dmd_chef_bureau()
    {
        return $this->belongsTo(User::class, 'id_chef_bureau');
    }
    public function dmd_chef_division()
    {
        return $this->belongsTo(User::class, 'id_chef_division');
    }
    public function dmd_damf()
    {
        return $this->belongsTo(User::class, 'id_damf');
    }
}
