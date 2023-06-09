@extends('base')

@section('title')
    Taches en cours
    
@endsection

@section('content')

<div class=" text-center my-5">
    <h3 class="text-info">Vos taches non démarrées</h3>
</div>

<table class="table table.striped">
    <thead>
        <tr>
            <th>Tache</th>
            <th>Démarrage </th>
            <th>Deadline</th>
            <th>Niveau</th>
            <th class="text-end">Actions</th>

        </tr>
    </thead>
    <tbody>

        @forelse ($taches as $tache)
            <tr>
                
                <td>{{ $tache->name }}</td>
                <td>{{ $tache->getDate($tache->begin_at) }}</td>
                <td>{{ $tache->getDate($tache->finish_at)}}</td>
                <td class="font-weight-bold @if($tache->level == 'low') text-secondary  @elseif($tache->level == 'high') text-danger @elseif($tache->level == 'medium') text-warning @endif">{{ Str::ucfirst($tache->level) }}</td>
                <td>
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <a href="{{ route('taches.edit', ['tach' => $tache->id ]) }}" class="btn btn-primary">Editer</a>
                        {{-- Pour vérifier si l'utilisateur a le droit avant d'afficher le bouton --}}

                            <form action="{{ route('taches.destroy', $tache->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Supprimer</button>
                            </form>
                            <form action="{{ route('taches.marque.begin', $tache->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn  btn-info">Demarrer</button>
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

{{ $taches->links() }}
    
@endsection