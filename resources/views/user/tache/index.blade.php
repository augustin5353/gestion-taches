@extends('base')
@section('title')
    Mes taches
@endsection
<?php
$route = request()->route()->getName();
?>
@section('content')
<div class="container-xxl">
    

<?php
$route = request()->route()->getName();
?>

<div class=" text-start mt-5">
<h3 class="text-info">Toutes vos taches</h3>
</div>
@include('user.tache.taskCard')


<div>
{{ $tasks->links() }}
</div>
</div>


@endsection('content')



