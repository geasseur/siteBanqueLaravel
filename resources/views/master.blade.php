<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>compte du porc {{session('pseudo')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/style.js"></script>

    </head>
    <body class=''>
      @if(session('error'))
        <p class='text-center error' onclick="$(document).ready(function(){
          $('.error').hide();
        });">{{session('error')}} <br> <small>cliquez ici pour supprimer le message</small> </p>
        <?php Session::forget('error');  ?>
      @endif
      <header>
        <h1 class='text-center mb-3'>Banque Ocus Porkus</h1>
        @yield('header')
      </header>
      <main>
        @yield('content')
      </main>
      <footer>
        @yield('footer')
      </footer>
    </body>
</html>
