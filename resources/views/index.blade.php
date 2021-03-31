<!doctype html>
<html>
  <head>
    <title>Charts with Laravel</title>
  </head>
  <body>
    <h1> Charts</h1>

    {!! $ch_affectation->container() !!}
    {!! $ch_magasin->container() !!}


  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
  
  {!! $ch_affectation->script() !!}  
  {!! $ch_magasin->script() !!}  
</body>
</html>