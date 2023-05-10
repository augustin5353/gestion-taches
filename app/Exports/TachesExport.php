<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;



//FromCollection, 
class TachesExport implements FromView
{
    //pour format csv
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    //On précise ici la collection à exporter, ce que retourne cette fonction
    /* public function collection()
    {
        $user = User::find(Auth::id());
        $taches = $user->taches()->get();
        return $taches;
    } */
    public function view(): View
    {
        $user = User::find(Auth::id());
        $taches = $user->taches()->whereNotNull('finished_at')->get();

        return view(
            'exports.taches', [
                'taches' => $taches
            ]
            );
    }
}
