@extends('base')

@section('title', $group->id == null ? 'Créer un group' : 'Modifier un groupe')
    

@section('content')


<div class="ml-4">
    
    <div class="row">

        <div class="col mt-4">

                <form class="vstack gap-3" action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
        
                    @csrf
                    @method('post')
            
                    @include('shared.input', [
                        'name' => 'name',
                        'holder' => 'Nom du groupe',
                        'value' => $group->name
                    ])
                
                    @include('shared.input', [
                            'name' => 'description',
                            'holder' =>'Décrivez la tache',
                            'type' => 'textarea',
                            'value' => $group->description
                    ])
        
                    <div>
                        <button class="btn btn-secondary mb-5">
        
                            @if ($group->id == null )
                                Créer
                            @else
                                Modifier
                            @endif
                    </button>
                    </div>
            </form>

            <p class="text-start">
                Rechercehr d'utilisateur pour en ajouter
            </p>

            <form action="" method="get" class="container d-flex gap-2">
                <input type="text" placeholder="Search users" name="name" class="form-control" value="{{ $input['name'] ?? ''}}">
                <button class="btn btn-primary flex-grow-0">
                    Rechercher
                </button>
            </form>

            <div>
                <table class="table table.striped">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            @forelse ($addUsers as $user)
                            <td>{{ $user->name}}</td>

                            <td>
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <form action="{{ route('notify.user.to.join.group', ['group' => $group, 'user' => $user])}}" method="post">
                                        @csrf
                                        <button class="btn btn-secondary">Inviter</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                            
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            
            </div>
        
        </div>
        <div class="col-5 mt-4">
            <div class="text-center">
                <div class="d-flex p-2 bd-highlight justify-between">
                    <h5>Les tahes du groupe</h5>
                    <a href="{{ route('taches.create', ['group' => $group])}}">Ajouter une tache</a>
                </div>
                <table class="table table.striped">
                    <thead>
                        <tr>
                            <th>Tache</th>
                            <th>Date de démarrage</th>
                            <th>Terminer le </th>
                            <th>Niveau</th>
                            <th class="text-end">Actions</th>
                
                        </tr>
                    </thead>
                    <tbody>
                
                            <tr>

                                @forelse ($group->tasks as $task)
                                
                                <td>{{ $task->name }}</td>
                                <td>{{  $task->getDate($task->begin_at) }}</td>
                                <td>{{ $task->getDate($task->finish_at)  }}</td>
                                <td class="font-weight-bold @if($task->level == 'low') text-secondary  @elseif($task->level == 'high') text-danger @elseif($task->level == 'medium') text-warning @endif">
                                    {{ Str::ucfirst($task->level) }}</td>
                                <td>
                                    <div class="d-flex gap-2 w-100 justify-content-end">                
                                        <a href="{{ route('taches.edit', ['group' => $group, 'task' => $task]) }}" class="btn btn-primary">Détails</a>
                
                                          <form action="{{ route('taches.destroy', $task) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Supprimer</button>
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
            </div>
        </div>
        <div class="col mt-4">
            <div>
                <div class="d-flex p-2 bd-highlight justify-between">
                    <h5>Les membres</h5>
                </div>
                <div>
                    <table class="table table.striped">
                        <thead>
                            <tr>
    
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                @forelse ($group->users as $user)
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>  
                                <td>
                                    <a href="{{ route('group.remove.user', ['group' => $group, 'user' => $user])}}">Retirer</a>
                                </td>
                            </tr>
                                
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                
                </div>

                
            </div>
                
        </div>
      
    </div>
</div>
      
@endsection
