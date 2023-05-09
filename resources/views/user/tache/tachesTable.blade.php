<?php
    $route = request()->route()->getName();
?>

<div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('taches.index') }}" class="@if ($route == 'taches.index')
        text-dark
    @endif">Toutes mes taches</a>

    <a href="{{ route('taches.en_cours') }}" class="@if ($route == 'taches.en_cours')
    text-dark
    @endif">Taches  en cours</a>

    <a href="{{ route('taches.terminees') }}" class="@if ($route == 'taches.terminees')
    text-dark
    @endif">Taches terminées</a>

    <a href="{{ route('taches.a_venir') }}" class="@if ($route == 'taches.a_venir')
    text-dark
    @endif">Taches à venir</a>

    
</div>

<table class="table table.striped">
    <thead>
        <tr>
            <th>Tache</th>
            <th>Devrait démarrer le  </th>
            <th>A terminer le </th>
            <th>Urgent</th>
            <th>Important</th>
            <th>Pas urgent</th>
            <th class="text-end">Actions</th>

        </tr>
    </thead>
    <tbody>

        @forelse ($taches as $tache)
            <tr>
                
                <td>{{ $tache->name }}</td>
                <td>{{ $tache->begin_at }}</td>
                <td>{{ $tache->finish_at }}</td>
                <td>@if ($tache->level == "immediate")Oui @endif</td>
                <td>@if ($tache->level == "important")Oui @endif</td>
                <td>@if ($tache->level == "low")Oui @endif</td>

                <td>
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <a href="{{ route('taches.edit', ['tach' => $tache->id ]) }}" class="btn btn-primary">Editer</a>
                        {{-- Pour vérifier si l'utilisateur a le droit avant d'afficher le bouton --}}

                          <form action="{{ route('taches.destroy', $tache->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                          <form action="{{ route('taches.marque.finish', $tache->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-success">MCT</button>
                            </form>
                            
                    </div>
                </td>
            </tr>
        @empty
        <div>
            
        </div>
        @endforelse

    </tbody>
</table>