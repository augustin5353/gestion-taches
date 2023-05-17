@extends('base')

@section('title', $group->id == null ? 'Créer un group' : 'Modifier un groupe')
    

@section('content')



    
   <div class="m-5">
    
    <div class="row ">

        <div class="col-md-8 ">
            <div class="">
                <div class="text-start">
                    <div class="d-flex justify-content-between align-items-center my-5">
                        <h5>Les tahes du groupe</h5>
                        <a  href="{{ route('taches.create', ['group' => $group])}}">Ajouter une tache</a>
                    </div>
                    <table class="table table.striped">
                        <thead>
                            <tr>
                                <th>Tache</th>
                                <th>Date de démarrage</th>
                                <th>Terminer le </th>
                                <th>Niveau</th>
                                <th>Etat</th>
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
                                        {{ Str::ucfirst($task->level) }}
                                    </td>
                                    <td class="font-weight-bold">
                                        {{ $task->getTaskStatus() }}
                                    </td>
                                    <td>

                                        <div class="d-flex gap-2 w-100 justify-content-end">

                                            
                                            @if ($task->getTaskStatus() === 'Non démarrée')
                                            
                                            <form action="{{ route('taches.marque.finish', $task->id) }}" method="post">
                                                 @csrf
                                                 @method('put')
                                                 <button class="btn btn-success btn-sm">Démarrer</button>
                                            </form>
                                                
                                            @endif
                                            @if ($task->getTaskStatus() === 'En cours')
                                            
                                            <form action="{{ route('taches.marque.finish', $task->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-success btn-sm">MCT</button>
                                            </form>
                                                
                                            @endif

                                            @if ($task->finished_at === null)
                                            <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#groupUsers{{ $task->id }}" role="button" aria-expanded="false" aria-controls="groupUsers{{ $task->id }}">
                                                Confier à
                                            </a>
                                            <form action="{{ route('attach.task.users.in.group', ['task' => $task->id])}}" method="post" class="form-group collapse" id="groupUsers{{ $task->id }}">

                                                @csrf
                                                @method('post')
                                                <select class="form-select" multiple aria-label="multiple select example" name="users[]">
                                                    @forelse ($group->users as $user)
                                        
                                                        <option value="{{$user->id}}">
                                                            {{$user->name}}
                                                        </option>
                                                                                
                                                    @empty
                                                                                
                                                    @endforelse
                                                                        
                                                </select>
                                        
                                                <div class="mt-3 text-end">
                                                <button type="submit" class="btn btn-primary btn-sm">Sauvegarder</button>
                                                </div>
                                            </form>
                                            @endif

                                            <a href="{{ route('taches.edit', ['group' => $group, 'task' => $task]) }}" class="btn btn-secondary btn-sm">Détails</a>
                    
                                            <form action="{{ route('taches.destroy', $task) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">Supprimer</button>
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
            

            
















                    
            <div>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Ajouter un utilisateur
                </a>
            </div>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <p class="text-start">
                        Rechercehr d'utilisateur pour en ajouter
                    </p>
        
                    <form action="" method="get" class=" d-flex gap-4">
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
              </div>
        </div>
        <div class="col-md-4">

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
        
                    <div class=" text-end mt-3">
                        <button class="btn btn-secondary mb-5">
        
                            @if ($group->id == null )
                                Créer
                            @else
                                Modifier
                            @endif
                    </button>
                    </div>
            </form>

        
        </div>


       
      
    </div>
   </div>
  
      
@endsection
