
@extends('base')

@section('title', $tache->id == null ? 'Créer une tacte': 'Midifier la tacche numéro ' . $tache->id)

@section('content')

    <h1 class="mb-20 mt-lg-n1">@yield('title')</h1>

    <form class="vstack gap-3" action="{{ route('taches.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('post')

        @include('shared.input', [
            'name' => 'name',
            'holder' => 'Nom de la tache',
            'value' => $tache->name
        ])
    
        @include('shared.input', [
                'name' => 'description',
                'holder' =>'Décrivez la tache',
                'type' => 'textarea',
                'value' => $tache->description
        ])

        @include('shared.input', [
            'name' => 'begin_at',
            'holder' =>'date debut',
            'type' => 'datetime-local',
            'label' => 'Date debut',
            'value' => $tache->begin_at
        ])

        @include('shared.input', [
                'name' => 'finish_at',
                'holder' =>'date fin',
                'type' => 'datetime-local',
                'label' => 'Date fin',
                'value' => $tache->finish_at,
        ])

        
        <div class="form-group form-check-inline">

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="immediate" value="immediate" @checked($tache->level == 'immediate')>
                <label class="form-check-label" for="immediate">Urgent</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="important" value="important" @checked($tache->level == 'important') @checked($tache->id == null)>
                <label class="form-check-label" for="important">Important</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="lower" value="low" @checked($tache->level == 'low')>
                <label class="form-check-label" for="lower">Pas urgent</label>
            </div>
        
        </div>

        <div>
            @if ($tache->id !== null)
                @if ($tache->beginned_at !== null)
                    @include('shared.input', [
                    'name' => 'beginned_at',
                    'holder' =>'date fin',
                    'type' => 'datetime-local',
                    'label' => 'Cette tache à demarré le:',
                    'value' => $tache->beginned_at,
                    ])
                @else
                    <h4>Tache non démarrée</h4>
                    @include('shared.input', [
                    'name' => 'beginned_at',
                    'type' => 'hidden',
                    'label' => ' ',
                    ])
                @endif

                @if ($tache->finished_at !== null)
                    @include('shared.input', [
                    'name' => 'finished_at',
                    'holder' =>'date fin',
                    'type' => 'datetime-local',
                    'label' => 'Cette tache est terminée le:',
                    'value' => $tache->finished_at,
                    ])
                @else   
                    @include('shared.input', [
                    'name' => 'finished_at',
                    'type' => 'hidden',
                    'label' => ' ',
                    ])
                @endif
            @endif
        </div>



        

        <div class=" form-group">

        </div>




    {{-- <div class=" form-group">
        <label for="begin_at">Date debut:</label>
        <input type="text" class="form-control datepicker" id="begin_at" name="begin_at">
    </div>

    <div class=" form-group">
        <label for="finish_at">Date fin:</label>
        <input type="text" class="form-control datepicker" id="finish_at" name="finish_at">
    </div>
 --}}
        <div >
            <button class="btn btn-primary">

                    @if ($tache->id == null )
                        Créer
                    @else
                        Modifier
                    @endif
            </button>
        </div>
    </form>

    <script>
        // Initialisation du datepicker Bootstrap
        
    </script>
@endsection


