@extends('layouts.admin')

@section('contenu')
    <div id="page-wrapper" style="min-height: 301px;">      
        <div class="col-lg-7">
            <div class="p-5">
                <form class="text-center border border-primary p-5 rounded" method="POST">
                    @csrf
                    <p class="h4 mb-4">Lieu d'affectation</p>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="dutyStation" name="lieu" placeholder="Lieu d'affectation">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 text-center">
                            {{-- <input type="submit" name="submit" value="Enregistrer">  --}}
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
        
                           {{--  <a href={{url('bureau')}} class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Enregistrer</span>
                            </a> --}}
                        </div>
                        <div class="col-sm-6 text-center">
                            <button type="submit" class="btn btn-danger">Annuler</button>
                            {{-- <a href="#" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Annuler</span>
                            </a> --}}
                        </div>
                    </div>
        
                </form>
            </div>
        </div>
    </div>
@endsection
