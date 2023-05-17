@extends('base')

@section('title')
    Taches en cours
    
@endsection

@section('content')
<div class=" container-xxl">
    
<div class=" text-start mt-5">
    <h3 class="text-info">Vos taches en cours</h3>
</div>
@include('user.tache.taskCard')

<div class=" my-5">
    {{ $tasks->links() }}
</div>
    
</div>
@endsection