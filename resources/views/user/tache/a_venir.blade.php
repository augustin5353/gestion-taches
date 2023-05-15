@extends('base')

@section('title')
    Taches en cours
    
@endsection

@section('content')

<div class=" container-xxl">
    <div class=" text-start mt-5">
        <h3 class="text-info">Vos taches non démarrées</h3>
    </div>
    
    @include('user.tache.taskCard')
    
    {{ $tasks->links() }}
</div>
    
@endsection