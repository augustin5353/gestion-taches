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
    
        $pdf = Pdf::loadView('user.exportData.pdf.taches', [
            'taches' => $taches
        ]);

        return $pdf->download('taches.pdf');
    }
}