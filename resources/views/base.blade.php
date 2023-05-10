<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <link href=”https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css” rel=”stylesheet”> 
    <script src=”https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js”></script> 
    <script src=”https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js”></script>

    {{-- datetimepickker --}}

    <script type=”text/javascript” src=”https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js”></script>
    <link href=”https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css” rel=”stylesheet”>
    <script src=”https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js”> </script>

    @vite(['resource/css/app.css', 'resource/js/app.js'])


    <style>
        @layer reset{
          button {
            all:unset;
          }
        }
      
      </style>  
</head>
<body>

    <?php
      $route = request()->route()->getName();
      ?>
    <div class="p-3 mb-2 bg-primary ">
          <ul class="nav  ">
        
            <li class="nav-item" >
              <a class="nav-link @if($route == 'taches.index')
              text-dark
              @else
              text-white
            @endif"  href="{{ route('taches.index', [
              'typeTache' => 'en_cours'
            ]) }}" >Mes taches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(str_contains($route, 'create'))
                text-dark
                @else
              text-white
              @endif"  href="{{ route('taches.create') }}">Nouvelle tache</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(str_contains($route, 'profile.'))
                text-dark
                @else
              text-white
              @endif"  href="" tabindex="-1" aria-disabled="false">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(str_contains($route, 'statistiques.'))
                text-dark
                @else
              text-white
              @endif"  href="{{ route('taches.statistiques') }}" tabindex="-1" aria-disabled="false">Statistiques</a>
            </li>
    
            {{-- @class(['nav-link text-white', 'action' => str_contains($route, 'option.')]) --}}

            <li class="nav-item ">
                @auth
            
              
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
          
                    <button type="submit" class="nav-link text-white ">
                        {{ __('Log Out') }}
                    </button>
                  </form>
                @endauth
                
                @guest
                    <a class="nav-link text-white" href="">Se connecter</a>
                @endguest
            </li>

          </ul>

      </div>
      
    </div>





    <div class="container nt-3">

      
        @include('shared.flash')

        @yield('content')

    </div>
    
    <script>
      //tomSelect est une librairie pour modifier l'apparence de la balise select
      new TomSelect('select[multiple]', {plugins: {remove_button: 'Supprimer'}})
    </script>

  </body>
</html>
