@extends('base')

@section('title')
    Dashboard
@endsection


@section('content')
<div class=" container-xxl">
  <?php
      $route = request()->route()->getName();
      ?>
<div class="container-fluid my-3">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-3">
        <!-- Sidebar -->
        <div class="mb-3"><h3 class=" text-info ">Menu</h3></div>
        <div class="sidebar ">
          
          <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="{{ route('taches.index') }}" class=" @if ($route == 'taches.index')
                text-dark
            @endif fs-5">Toutes mes taches</a>
            </li>
            
            <li class="nav-item mb-3">
              <a href="{{ route('taches.terminees') }}" class=" @if ($route == 'taches.terminees')
            text-dark
            @endif fs-5" >Taches  Terminées</a>
        
            </li>
            <li class="nav-item mb-3">
              <a href="{{ route('taches.en_cours') }}" class=" @if ($route == 'taches.en_cours')
            text-dark
            @endif fs-5">Taches  en cours</a>
        
            </li>
            
            <li class="nav-item mb-3">
                <a href="{{ route('taches.a_venir') }}" class=" @if ($route == 'taches.a_venir')
            text-dark
            @endif fs-5">Taches non démarrées</a>
            </li>
            <li class="nav-itemmb-3">
                <a href="{{ route('taches.export.view') }}" class="fs-5">Exporter les données</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <!-- Contenu principal -->
        <div class=" text-center">
          <h3 class=" text-info mb-4">Statistiques des taches</h3>
          <div>
            
            @include('user.tache.statistiques')
          </div>
        </div>
      </div>
    </div>
    <h5 class="mt-3">Les taches à écheance plus proche</h5>
    @include('user.tache.taskCard')
  </div>
</div>
@endsection