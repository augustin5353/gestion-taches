<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateTacheRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(){

        $user = User::find(Auth::id());
 
         
 
         $taches = $user->taches()->recentTask()->whereDate('finish_at', '>=', now())->limit(6)->get();
 
         return view('user.tache.home', [
 
             
             'taches' => $taches,
 
         ]);
      }
 
      public function dashboard(){
         $user = User::find(Auth::id());
 
         $nbrTotalTaches = $user->taches()->count();
 
         $user = User::find(Auth::id());
 
         $tasks = $user->taches()->whereDate('finish_at', '<=', Carbon::now()->addDays('3'))->whereDate('finish_at', '>=', now())->recentTask()->nullDate('finished_at', true)->limit(6)->get();
 
         $nbrTachesTerminees = $user->taches()->nullDate('finished_at', false)->count();
         $nbrTachesTermineesEnRetard = $user->taches()->nullDate('finished_at', false)->compareDate('finished_at', DB::raw('finish_at'))->count();
 
         $nrbTachesNondemarrees =  $user->taches()->whereNull('beginned_at')->count();
 
         $nbrTachesEnCours = $user->taches()->whereNotNull('beginned_at')->nullDate()->count();
         $nbrTachesDemarreesEnRetard = $user->taches()->whereNotNull('beginned_at')->compareDate('beginned_at', DB::raw('begin_at'))->count();
 
     
         return view('dashboard', [
             'nbrTotalTaches' => $nbrTotalTaches,
             'nbrTachesTerminees' => $nbrTachesTerminees,
             'nbrTachesTermineesEnRetard' => $nbrTachesTermineesEnRetard,
             'nrbTachesNondemarrees' => $nrbTachesNondemarrees,
             'nbrTachesEnCours' => $nbrTachesEnCours,
             'nbrTachesDemarreesEnRetard' => $nbrTachesDemarreesEnRetard,
             'tasks' => $tasks
         ]);
     }
 
 
     public function index()
     {
         /* $date = Carbon::create(now());
         $date->addDays(30); */
 
         $taches = Task::all();
         
        $user = User::find(Auth::id());
 
        
 
 
         $tasks = $user->taches()->recentTask()->recentTask('created_at')->paginate(15);
 
         
 
         return view('user.tache.index', [
             'tasks' => $tasks,
 
         ]);
     }
     public function tachesEncours()
     {
         /* $date = Carbon::create(now());
         $date->addDays(30); */
 
         $user = User::find(Auth::id());
 
 
 
         $tasks = $user->taches()->whereNotNull('beginned_at')->whereNull('finished_at')->recentTask()->paginate(15);
 
         return view('user.tache.en_cours', [
             'tasks' => $tasks
         ]);
     }
     public function tachesAVenir()
     {
         /* $date = Carbon::create(now());
         $date->addDays(30); */
 
         $user = User::find(Auth::id());
 
 
 
         $tasks = $user->taches()->whereNull('beginned_at')->recentTask()->paginate(15);
 
         return view('user.tache.a_venir', [
             'tasks' => $tasks
         ]);
     }
 
     public function tachesTerminees()
     {
         /* $date = Carbon::create(now());
         $date->addDays(30); */
 
         $user = User::find(Auth::id());
 
 
 
         $tasks = $user->taches()->whereNotNull('beginned_at')->whereNotNull('finished_at')->paginate(15);
 
         return view('user.tache.terminees', [
 
             
             'tasks' => $tasks
         ]);
     }
 
     public function marqueToFinish ($id){
         $tache = Task::find($id);
 
         $tache->finished_at = now();
 
         $tache->save();
 
         return back();
     }
 
     public function marqueToBegin  ($id){
         $tache = Task::find($id);
 
         $tache->beginned_at = now();
 
         $tache->save();
 
         return back()->with('success', 'Tache: '.$tache->name . ' démarrée');
     }
 
     public function setNotifiableColumn($tache){
 
         $tache = Task::find($tache);
         $tache->notifiable = false;
         $tache->save();
 
         return to_route('taches.edit', $tache)->with('success', 'Vous n\'allez plus recevoir de notifications pour cette tache');
 
     }
 
     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         
         return view('user.tache.edit', [
             'tache' => new Task()
         ]);
     }
 
     /**
      * Store a newly created resource in storage.
      */
     public function store(CreateTacheRequest $request, Task $tache)
     {
 
         $id = Auth::id();
 
         $data = [
             'name' => $request->validated('name'),
             'description' => $request->validated('description'),
             'begin_at' => $request->validated('begin_at'),
             'finish_at' => $request->validated('finish_at'),
             'beginned_at' => $request->input('beginned_at'),
             'finishes_at' => $request->input('finishes_at'),
             'notifiable' => $request->input('notifiable'),
             'user_id' => $id
         ];
 
         if($tache->id == null){
 
             $tache = Task::create($data);
             $tache->user()->associate($id);
             $tache->save();
             return to_route('taches.index')->with('success', 'Tache crée avec succès');
 
         }else
         {
             $tache->update($data);
             return to_route('taches.index')->with('success', 'Tache modifiée avec succès');
         }
 
         
     }
 
     /**
      * Display the specified resource.
      */
     public function show(Task $tache)
     {
         return view('user.tache.create', [
             'tache' => $tache
         ]);
     }
 
     /**
      * Show the form for editing the specified resource.
      */
     public function edit( $tache)
     {
         $tache = Task::find($tache);
         return view('user.tache.edit', [
             'tache' => $tache
         ]);
     }
 
     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, Task $tache)
     {
         //
     }
 
     /**
      * Remove the specified resource from storage.
      */
     public function destroy($tache)
     {
         $tache = Task::find($tache);
 
         $tache->delete();
 
         return to_route('taches.index')->with('Suppression effectuée avec succès');
     }
}
