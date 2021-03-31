@extends('layouts.admin')

@section('contenu')
    <div id="page-wrapper" style="min-height: 301px;">      
        <div class="col-lg-7">
            <div class="p-5">
                <form class="text-center border border-primary p-5 rounded" action="/edit" method="POST">
                    @csrf
                    <p class="h4 mb-4">Modifier Lieu d'affectation</p>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" name="lieu" value="{{$data['lieu']}}">
                        </div>
                        <div class="col-sm-6">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 text-center">
                            <button type="submit" class="btn btn-primary">Enregistrer</button> 
                        </div>
                        <div class="col-sm-6 text-center">
                            <button type="submit" class="btn btn-danger">Annuler</button>
                        </div>
                    </div>
        
                </form>
            </div>
        </div>
    </div>
@endsection
