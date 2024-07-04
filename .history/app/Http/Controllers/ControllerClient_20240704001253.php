<?php
/**
 * ControllerClient handles client-related requests and actions.
 *
 * @category Controllers
 * @package  App\Http\Controllers
 * @author   Allégresse CAKPO <allegressecakpo93@gmail.com>
 * @license  MIT License
 * @link    http://example.com
 * @version  PHP 7.4+
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Demandes as Demande;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

/**
 * ControllerClient handles client-related requests and actions.
 *
 * @category Controllers
 * @package  App\Http\Controllers
 */
class ControllerClient extends Controller
{
    /**
     * Display the client's home page.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        return view('client.Home', compact('user'));
    }

    /**
     * Handle client form submission.
     *
     * @param Request $request The request instance.
     * @param int     $id      The client ID.
     *
     * @return \Illuminate\View\View
     */
    public function handleClientForm(Request $request, $id)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $use = User::where('id', '=', $id)->first();

        $nom = $use->firstname;
        $prenom = $use->lastname;
        $check_type_prs = Demande::where('nom_client', '=', $nom)
            ->where('prenom_client', '=', $prenom)
            ->first();

        if (!$check_type_prs) {
            $check_type_prs = Demande::where('nomsociete', '=', $nom)
                ->where('nomsociete', '=', $prenom)
                ->first();
        }

        $type_prs = $check_type_prs ? $check_type_prs->type_prs : null;

        $data = $request->all();
        $num_doss = $data['numero_dossier'];
        $date_depot = $data['date_depot'];

        if ($type_prs == 'morale') {
            $demandes = Demande::where('numero_doss', '=', $num_doss)
                ->where('date', '=', $date_depot)
                ->where('nomsociete', '=', $nom)
                ->where('nomsociete', '=', $prenom)
                ->first();
            $demande = Demande::where('numero_doss', '=', $num_doss)
                ->where('date', '=', $date_depot)
                ->get();
        } else {
            $demandes = Demande::where('numero_doss', '=', $num_doss)
                ->where('date', '=', $date_depot)
                ->where('nom_client', '=', $nom)
                ->where('prenom_client', '=', $prenom)
                ->first();
            $demande = Demande::where('numero_doss', '=', $num_doss)
                ->where('date', '=', $date_depot)
                ->get();
        }

        $test = count($demande);
        $pic = 0;

        if ($demandes == null || $test == 0) {
            $message = 'La demande n\'est pas la votre désolé ou La demande n\'existe pas désolé !';
            return view('client.demande_client_i', compact('user', 'message'));
        }

        if (in_array($demandes->status_dmd, ['Autorisée', 'Rejetée', 'Suspendu'])) {
            $pic = 1;
        }

        if ($test != 0) {
            return view('client.demande_client_t', compact('user', 'demande', 'pic'));
        }
    }

    /**
     * Generate and download a PDF for a specific demand.
     *
     * @param Request $request The request instance.
     * @param int     $id      The demand ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPDF(Request $request, $id)
    {
        $data = Demande::where('numero_doss', '=', $id)->get();
        view()->share('demande', $data);

        $pdf = PDF::loadView('client.pdf_view', [
            'numero_doss', 'date', 'nature_p', 'nature_op', 'montant', 'montant_con',
            'devise', 'nom_client', 'prenom_client', 'profess_client', 'tel_client',
            'banque_client', 'num_compt_client', 'status_dmd', 'devise', 'nom_benefi',
            'prenom_benefi', 'profess_benefi', 'pays_benifi', 'banque_benefi',
            'num_compt_benefi', 'date_decision'
        ]);

        return $pdf->download('Demande.pdf');
    }
}
