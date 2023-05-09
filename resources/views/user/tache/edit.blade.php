
@extends('base')

@section('title', 'Créer une tache')

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

            <input class="form-check-input" type="radio" name="level" id="immediate" value="immediate"  @checked($tache->level == 'immediate')> 
            <label class="form-check-label" for="immediate">Urgent</label>

            <input class="form-check-input" type="radio" name="level" id="important" value="important" @checked($tache->level == 'important') @checked($tache == null)>
            <label class="form-check-label" for="important">Important</label>

            <input class="form-check-input" type="radio" name="level" id="lower" value="lower" @checked($tache->level == 'low') >
            <label class="form-check-label" for="lower">Pas urgent</label>
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

                    Créer   

            </button>
        </div>
    </form>

    <script>
        // Initialisation du datepicker Bootstrap
        $(function () {
          $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
          });
        });
    </script>
@endsection


