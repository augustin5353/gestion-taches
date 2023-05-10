<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateTacheRequest;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */


        $taches = Tache::all();

        foreach($taches as $tahe){
            $tahe->user_id = 7;

            $tahe->save();
        }
       
       $user = User::find(Auth::id());

       


        $taches = $user->taches()->orderBy('begin_at', 'asc')->orderBy('created_at', 'asc')->paginate(15);

        

        return view('user.tache.index', [
            'taches' => $taches,

        ]);
    }
    public function tachesEncours()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $user = User::find(Auth::id());



        $taches = $user->taches()->whereNotNull('beginned_at')->whereNull('finished_at')->paginate(15);

        return view('user.tache.en_cours', [
            'taches' => $taches
        ]);
    }
    public function tachesAVenir()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $user = User::find(Auth::id());



        $taches = $user->taches()->whereNull('beginned_at')->paginate(15);

        return view('user.tache.a_venir', [
            'taches' => $taches
        ]);
    }

    public function tachesTerminees()
    {
        /* $date = Carbon::create(now());
        $date->addDays(30); */

        $user = User::find(Auth::id());



        $tachesTerminees = $user->taches()->whereNotNull('finished_at')->paginate(15);

        return view('user.tache.terminees', [

            
            'taches' => $tachesTerminees
        ]);
    }

    public function marqueToFinish ($id){
        $tache = Tache::find($id);

        $tache->finished_at = now();

        $tache->save();

        return back()->with('success', 'Tache: '.$tache->name . ' marquée comme terminée');
    }
    public function marqueToBegin  ($id){
        $tache = Tache::find($id);

        $tache->beginned_at = now();

        $tache->save();

        return back()->with('success', 'Tache: '.$tache->name . ' démarrée');
    }

    public function statistiques(){


        $user = User::find(Auth::id());

        $nbrTotalTaches = $user->taches()->count();

        $nbrTachesTerminees = $user->taches()->whereNotNull('finished_at')->count();
        $nbrTachesTermineesEnRetard = $user->taches()->whereNotNull('finished_at')->whereDate('finished_at', ">", DB::raw('finish_at'))->count();

        $nrbTachesNondemarrees =  $user->taches()->whereNull('beginned_at')->count();

        $nbrTachesEnCours = $user->taches()->whereNotNull('beginned_at')->whereNull('finished_at')->count();
        $nbrTachesDemarreesEnRetard = $user->taches()->whereNotNull('beginned_at')->whereNull('finished_at')->whereDate('beginned_at', ">", DB::raw('begin_at'))->count();

        
        return view('user.tache.statistiques', [
            'nbrTotalTaches' => $nbrTotalTaches,
            'nbrTachesTerminees' => $nbrTachesTerminees,
            'nbrTachesTermineesEnRetard' => $nbrTachesTermineesEnRetard,
            'nrbTachesNondemarrees' => $nrbTachesNondemarrees,
            'nbrTachesEnCours' => $nbrTachesEnCours,
            'nbrTachesDemarreesEnRetard' => $nbrTachesDemarreesEnRetard,
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
    public function store(CreateTacheRequest $request, Tache $tache)
    {

        $id = Auth::id();

        $data = [
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'begin_at' => $request->validated('begin_at'),
            'finish_at' => $request->validated('finish_at'),
            'beginned_at' => $request->input('beginned_at'),
            'finishes_at' => $request->input('finishes_at'),
            'user_id' => $id
        ];

        if($tache->id !== null){
            $tache = Tache::create($data);
            $tache->user()->associate($id);
            $tache->save();
        }else
        {
            $tache->update($data);
        }

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
