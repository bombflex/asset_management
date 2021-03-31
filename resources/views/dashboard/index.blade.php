@extends('layouts.admin')


@section('contenu') 
<div class="container table-responsive">
    <h3> Tableau de Bord</h3>
    <div class="row">
        <div class="col-md">
            {!! $ch_affectation->container() !!}
        </div>

        <div class="col-md">
              {!! $ch_magasin->container() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h5> Matériel Affectés</h5>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Quantité</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($affectation as $item)
                        <tr>
                            <td >{{$item->asset_description}}</td>
                            <td >{{$item->qte}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h5> Matériel Disponible</h5>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Quantité</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($magasin as $item)
                        <tr>
                            <td >{{$item->asset_description}}</td>
                            <td >{{$item->qte}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>

    

    {!! $ch_affectation->script() !!}  
    {!! $ch_magasin->script() !!}  

</div>

@endsection