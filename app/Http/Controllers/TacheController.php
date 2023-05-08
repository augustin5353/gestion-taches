<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTacheRequest;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $taches = $user->taches()->get();

        return view('user.tache.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.tache.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTacheRequest $request)
    {

        $date = [
            ''
        ];
        Tache::create($request->validated());

        return to_route('taches.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tache $tache)
    {
        return view('user.tache.show', [
            'tache' => $tache
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tache $tache)
    {
        //
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
    public function destroy(Tache $tache)
    {
        //
    }
}
