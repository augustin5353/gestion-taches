<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ExportDataController extends Controller
{
    public function downloadView()
    {

        $user = User::find(Auth::id());
        $taches = $user->taches()->get();
        return view('user.exportData.taches', [
            'taches' => $taches
        ]);
    }
    public function exportTachePdf()
    {
        $user = User::find(Auth::id());
        $taches = $user->taches()->get();
    
        //envoie de donnees à la vue qui sera télécharée(ce que le pdf va contenir)
        $pdf = Pdf::loadView('user.exportData.pdf.taches', [
            'taches' => $taches
        ]);

    
        //pour socker le pdf dans notre projet
        //return Pdf::loadFile(public_path('\\storage\\app\\public'))->save('taches.pdf')->stream('taches.pdf');


        //pour faire e télechargement une fois que user clique
        //return $pdf->download('taches.pdf');

        //pévisualiser le pdf, san télécharger
        return $pdf->stream('taches.pdf');
    }
}