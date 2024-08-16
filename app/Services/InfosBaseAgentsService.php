<?php

namespace App\Services;
use App\Models\user as user;
use App\Models\demandes as demande;

class InfosBaseAgentsService
{

public function getInfosDemande(){
    $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
    $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
    $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
    $demande_suspendre = demande::where('status_dmd', '=', 'suspendu')->get();
    $le_n_dmd_c = count($demande_encours);
    $le_n_dmd_v = count($demande_valider);
    $le_n_dmd_e = count($demande_echec);
    $le_n_dmd_s = count($demande_suspendre);
    
    $All_info=[
        'Tab_infos_demandes'=> [
            'demande_encours' => $demande_encours,
            'demande_valider' => $demande_valider,
            'demande_echec' => $demande_echec,
            'demande_suspendre' => $demande_suspendre,
    
        ],
        'Tab_nombre_infos_demandes'=>[
            'en_cours' => $le_n_dmd_c,
            'validees' => $le_n_dmd_v,
            'echouees' => $le_n_dmd_e,
            'suspendues' => $le_n_dmd_s,
        ],
        'date' => now()
        ];
    
    return ($All_info);
}
}
