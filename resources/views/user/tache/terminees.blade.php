@extends('base')

@section('title')
    Taches terminées
    
@endsection

@section('content')
<div class="container-xxl">
    
<div class=" text-center my-5">
    <h3 class="text-info">Vos taches terminées</h3>
</div>


@include('user.tache.taskCard')

{{ $tasks->links() }}
    
</div>
@endsection