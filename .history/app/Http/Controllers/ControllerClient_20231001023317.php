<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class ControllerClient extends Controller
{
    public function home()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        return view('client.Home', compact('user'));
    }
    public function Fclient(Request $request, $id)
    {

        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $use = User::where('id', '=', $id)->first();

        $nom = $use->name;
        $prenom = $use->firstname;

        $data = $request->all();
        $num_doss = $data['numero_dossier'];
        $date_depot = $data['date_depot'];

        $demande = demande::where('numero_doss', '=', $num_doss)
            ->where('date', '=', $date_depot)
            ->get();
        $test = count($demande);
        $demandes = demande::where('numero_doss', '=', $num_doss)
            ->where('date', '=', $date_depot)
            ->where('nom_client', '=', $nom)
            ->where('prenom_client', '=', $prenom)
            ->first();
        $pic = 0;
        if ($demandes == null) {
            return view('client.demande_client_t')->with('user'La demande n\'est pas la votre désolé');
        }
        if (($demandes->status_dmd == 'Autorisée') || ($demandes->status_dmd == 'Rejetée') || ($demandes->status_dmd == 'Suspendu')) {
            $pic = 1;
        } else {
            $pic = 0;
        }
        if ($test != 0) {
            return view('client.demande_client_t', compact('user', 'demande', 'pic'));
        }
        if ($test == 0) {
            return view('client.demande_client_i', compact('user'));
        }
    }
    // Generate PDF
    public function createPDF(Request $request, $id)
    {
        // retreive all records from db
        $data = demande::where('numero_doss', '=', $id)->get();
        // share data to view
        view()->share('demande', $data);


        $pdf = PDF::loadView('client.pdf_view', $data = ['numero_doss ', 'date', 'nature_p', 'nature_op', 'montant', 'montant_con', 'devise', 'nom_client', 'prenom_client', 'profess_client', 'tel_client', 'banque_client', 'num_compt_client', 'status_dmd', 'devise', 'nom_benefi',     'prenom_benefi', 'profess_benefi', 'pays_benifi', 'banque_benefi', 'num_compt_benefi', ' date_decision ']);
        //  download PDF file with download method
        return $pdf->download('Demande.pdf');
    }
}
