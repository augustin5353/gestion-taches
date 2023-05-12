@extends('base')

@section('title')
    Dashboard
@endsection


@section('content')
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
                <a href="{{ route('taches.index') }}" class="@if ($route == 'taches.index')
                text-dark
            @endif fs-5">Toutes mes taches</a>
            </li>
            
            <li class="nav-item mb-3">
              <a href="{{ route('taches.terminees') }}" class="@if ($route == 'taches.terminees')
            text-dark
            @endif fs-5" >Taches  Terminées</a>
        
            </li>
            <li class="nav-item mb-3">
              <a href="{{ route('taches.en_cours') }}" class="@if ($route == 'taches.en_cours')
            text-dark
            @endif fs-5">Taches  en cours</a>
        
            </li>
            
            <li class="nav-item mb-3">
                <a href="{{ route('taches.a_venir') }}" class="@if ($route == 'taches.a_venir')
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
    <div class=" mt-5">
      <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($tachesTerminesEcheanceProche as $tache)
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-titlev text-center">Echéance: {{ $tache->getDate($tache->finish_at)}} </h5>
                  <p class="card-text ">{{ $tache->description }}</p>
                  <p class="card-text text-center"><small class="text-muted">Démarrage: {{ $tache->getDate($tache->begin_at)}} </small></p>
                  <div class="card-footer text-center"><a href="{{ route('taches.edit', ['tach' => $tache->id])}}" class="stretched-link text-danger">{{ Str::ucfirst($tache->level) }}</a></div>
                </div>
              </div>
            </div>
        @empty
            
        @endforelse
        
      </div>
    </div>
  </div>
@endsection