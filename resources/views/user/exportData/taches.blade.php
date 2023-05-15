@extends('base')

@section('titlr')
    "Exporter les données"
@endsection

@section('content')
<div class="container-xxl">
    
    <div class=" text-center my-5">
        <h3 class="text-info">@yield('title')</h3>
    </div>
    
    

{{-- <div class="d-flex justify-content-between">
    <div><a href="{{ route('export.tache.pdf')}}">Télécharger le pdf</a></div>
    <div><a href="{{ route('export.tache.excel')}}">Télécharger le excel</a></div>
</div>
 --}}

 <div class=" text-center"><h3 class=" text-info mt-4">Exporter les données</h3></div>
<form class="vstack gap-3" action="{{ route('taches.export.tache') }}" method="post" enctype="multipart/form-data">

  @csrf
  @method('post')

  <div class="form-group form-check-inline my-5">

      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="donnees" id="terminnees" value="terminees" checked>
          <label class="form-check-label" >Les taches terminées</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="donnees" id="en_cours" value="en_cours">
          <label class="form-check-label">Les taches encours</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="donnees" id="a_venir" value="a_venir">
          <label class="form-check-label" >Les taches non démarrées</label>
      </div>
  
  </div>
  <div class="form-group form-check-inline my-5">

      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="format" id="immediate" value="pdf" checked>
          <label class="form-check-label" >Format pdf</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="format" id="important" value="excel" >
          <label class="form-check-label" >Format excel</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="format" id="lower" value="csv" >
          <label class="form-check-label" >Format csv</label>
      </div>
  
  </div>

  <div >
      <button class="btn btn-primary">

                  Exporter 
      </button>
  </div>
</form>
</div>
@endsection