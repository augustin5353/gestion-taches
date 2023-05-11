<?php

namespace App\Http\Controllers;

use App\Exports\TachesExport;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportData(Request $request){

        $user = User::find(Auth::id());

        $taches = $user->taches()->whereNotNull('finished_at')->get();

        $tachesEnCours = $user->taches()->whereNull('finished_at')->whereNotNull('beginned_at')->get();

        $option = true;

            switch ($option) {

            case ($request->input('donnees')=='terminees' && $request->input('format')=='pdf'):

                $pdf = Pdf::loadView('user.exportData.pdf.taches', [
                    'taches' => $taches
                ]);

                return $pdf->download('taches.pdf');

            case ($request->input('donnees')=='terminees' && $request->input('format')=='csv'):

                return Excel::download(new TachesExport($taches), 'taches.csv', \Maatwebsite\Excel\Excel::CSV);

            case ($request->input('donnees')=='terminees' && $request->input('format')=='excel'):

                return Excel::download(new TachesExport($taches), 'taches.xlsx', \Maatwebsite\Excel\Excel::XLSX);

            case (false):
                echo "Option 3 sélectionnée";
                break;
            default:
                dd("invalide");
            }

        

    }
}



/* public function exportTacheExcel()
    {


        //telechargement direct du ficheir
        //return Excel::download(new TachesExport, 'taches.xlsx');

        //sous format csv

        $user = User::find(Auth::id());
        $taches = $user->taches()->get(); 

        return Excel::download(new TachesExport, 'taches.csv', \Maatwebsite\Excel\Excel::CSV);

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
        return $pdf->download('taches.pdf');

        //pévisualiser le pdf, san télécharger
        
    } */