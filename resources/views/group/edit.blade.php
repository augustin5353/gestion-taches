@extends('base')

@section('title', $group->id == null ? 'Créer un group' : 'Modifier un groupe')
    

@section('content')
    <div class=" text-center my-5">
        <h3 class="text-info">@yield('tite')</h3>
    </div>

    <h1>bonjour</h1>

    <div>
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

            <button class="btn btn-primary mb-5">

                @if ($group->id == null )
                    Créer
                @else
                    Modifier
                @endif
        </button>
    </form>
    </div>

    

@endsection
