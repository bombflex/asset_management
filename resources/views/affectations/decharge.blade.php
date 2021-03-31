<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> 
     <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
{{-- 
     --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

    <!-- Script -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bootbox/bootbox.all.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

   
</head>
<body id="page-top">
    @foreach ($affectations as $item)

    <!-- Page Wrapper -->
    <div id="wrapper row">
        <div class="col-md-12 form-group row">

            <div class="col-md-12 p-3 mb-2 bg-primary text-white row">
                <div class="col-md-2"> 
                    <img src="{{ asset('img/logo-Unicef.png') }}" alt="Logo" style="width:120px;">
                </div>
                <div class="col-md-6 text-right">
                    <p>United Nations Children’s Fund</p>
                    <p>Fonds des Nations Unies pour l’enfance</p>
                    <p>01 BP 3420 Ouagadougou Burkina Faso</p>
                </div>
                
                <div class="col-md-4 text-left">
                    <p>Telephone 25 49 07 00</p>
                    <p>Facsimile 25 30 09 68</p>
                    <p>www.unicef.org</p>
                </div>
                <br>
                <br>
            </div>
            <div class="col-md-12 row">
                <h3 class="col-md-12 text-center upper">Décharge pour remise de materiel </h3>
                <h3 class="col-md-12 text-center upper">Unicef</h3>
                <p class="col-md-12 text-center upper">________________________________________________________</p>
                

                <br>
                <br>
                <br>
                <br>
                @foreach ($affectations as $item)
                    <label for="d_nom" class="col-md-2 col-form-label">Je soussigné(e) : </label>
                    <div class="col-md-10">
                        <input type="text" readonly class="form-control-plaintext" id="d_nom" value="{{$item->nom_emp}}">
                    </div>
                    <label for="d_fonction" class="col-md-2 col-form-label">Title: </label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="d_fonction" value="{{$item->fonction_emp}}">
                    </div>
                @endforeach
                
                <p>Reconnais avoir recu le materiel suivant : </p>

                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col"># Inventaire</th>
                        <th  scope="col">Description</th>
                        <th  scope="col"># de Série</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$item->inv_laptop}}</td>
                            <td>{{$item->desc_laptop}}</td>
                            <td>{{$item->serial_laptop}}</td>
                        </tr>
                
                        <tr>
                            <td>{{$item->inv_radio}}</td>
                            <td>{{$item->desc_radio}}  ({{$item->callsign}}) </td>
                            <td>{{$item->serial_radio}}</td>
                        </tr>
                        <tr>
                            <td>{{$item->inv_thuraya}}</td>
                            <td>{{$item->desc_thuraya}}</td>
                            <td>{{$item->serial_thuraya}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <label for="d_date" class="col-form-label">Date : </label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control-plaintext" id="d_date" value="{{$item->created_at}}">
                    </div>
            </div>
            
        </div>
        
    </div>
    @endforeach

</body>
<html>