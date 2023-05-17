<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    

</head>
<body>

    <?php
      $route = request()->route()->getName();
      ?>

<div class="jumbotron text-center">

</div>



       @include('shared.flash')

          
        @yield('content')

  </body>
</html>
