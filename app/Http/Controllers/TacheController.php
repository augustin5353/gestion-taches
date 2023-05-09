<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTacheRequest;
use App\Models\Tache;
use App\Models\User;
use Carbon\Carbon;
use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $uesr_id = Auth::id();

        $user = User::find($uesr_id);

        $taches = $user->taches()->paginate(15);

        

        return view('user.tache.index', [
            'taches' => $taches,

        ]);
    }
    public function tachesEncours()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $uesr_id = Auth::id();

        $user = User::find($uesr_id);



        $taches = $user->taches()->whereNotNull('beginned_at')->whereNull('finished_at')->paginate(15);

        return view('user.tache.en_cours', [
            'taches' => $taches
        ]);
    }
    public function tachesAVenir()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $uesr_id = Auth::id();

        $user = User::find($uesr_id);



        $taches = $user->taches()->whereNull('beginned_at')->paginate(15);

        return view('user.tache.a_venir', [
            'taches' => $taches
        ]);
    }

    public function tachesTerminees()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $uesr_id = Auth::id();

        $user = User::find($uesr_id);



        $tachesTerminees = $user->taches()->whereNotNull('finished_at')->paginate(15);


        

        return view('user.tache.terminees', [
            'taches' => $tachesTerminees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('user.tache.edit', [
            'tache' => new Tache()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTacheRequest $request)
    {

        $id = Auth::id();

        $data = [
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'begin_at' => $request->validated('begin_at'),
            'finish_at' => $request->validated('finish_at'),
            'user_id' => $id
        ];

        $tache = Tache::create($data);


        $tache->user()->associate($id);

        $tache->save();

        

        return to_route('taches.index')->with('success', 'Tache créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tache $tache)
    {
        dd($tache->name);
        return view('user.tache.create', [
            'tache' => $tache
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $tache)
    {
        $tache = Tache::find($tache);
        return view('user.tache.edit', [
            'tache' => $tache
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tache $tache)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tache)
    {
        $tache = Tache::find($tache);

        $tache->delete();

        return to_route('taches.index')->with('Suppression effectuée avec succès');
    }
}
