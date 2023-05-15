<?php

namespace App\Http\Controllers;

use App\Events\JoinGroupEvent;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::paginate(15);

        return view('group.index', [
            'groups' => $groups
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('group.edit', ['group' => new Group()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        $user = User::find(Auth::id());

        $group = Group::create($request->validated());

        //associer le group nouvellement créé à l'utilisateur connecté, donc le group va contenir user_id = user->is
        $group->user()->associate($user->id);

        $group->save();

        //mettre l'utilisateur qui à créé le groupe comme membre du groupe à travers la table group_user
        $user->groups()->attach($group->id);

        return to_route('group.index', ['group'=>$group])->with('success', 'Groupe '. $group->id.' modifié avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('group.edit', ['group' => $group]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return to_route('group.index')->with('success', 'Groupe '. $group->id.' modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }

    public function addUser($group, $user){

        $group = Group::find($group);

        $user = User::find($user);

        event(new JoinGroupEvent($group, $user));

        dd('ok');

    }
}