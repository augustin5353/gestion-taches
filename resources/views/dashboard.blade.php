@extends('base')

@section('title')
    Dashboard
@endsection


@section('content')
<?php
      $route = request()->route()->getName();
      ?>
<div class="container-fluid my-3">
    <div class="row">
      <div class="col-md-3">
        <!-- Sidebar -->
        <div class="mb-3"><h3 class=" text-info ">Menu</h3></div>
        <div class="sidebar ">
          
          <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="{{ route('taches.index') }}" class="@if ($route == 'taches.index')
                text-dark
            @endif">Toutes mes taches</a>
            </li>
            
            <li class="nav-item mb-3">
              <a href="{{ route('taches.terminees') }}" class="@if ($route == 'taches.terminees')
            text-dark
            @endif">Taches  Terminées</a>
        
            </li>
            <li class="nav-item mb-3">
              <a href="{{ route('taches.en_cours') }}" class="@if ($route == 'taches.en_cours')
            text-dark
            @endif">Taches  en cours</a>
        
            </li>
            
            <li class="nav-item mb-3">
                <a href="{{ route('taches.a_venir') }}" class="@if ($route == 'taches.a_venir')
            text-dark
            @endif">Taches non démarrées</a>
            </li>
            <li class="nav-itemmb-3">
                <a href="{{ route('taches.export.view') }}" class="">Exporter les données</a>
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
  </div>
@endsection