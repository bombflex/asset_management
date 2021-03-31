@extends('layouts.admin')

@section('contenu')
    <form action="{{route('employe.store')}}" method="POST">
        @csrf
        
        <fieldset class="form-group border border-primary rounded p-2">
            <legend  class="w-auto col-form-label"> Informations Personnelles </legend>
                <div class="row">
                    <div class="col-md-4"> 
                        <input type="text" class="form-group form-control form-control-user" id="prenom(s)" name="prenom"  placeholder="Prénom(s)...">   
                        <input type="text" class="form-group form-control form-control-user" id="nom" name="nom"  placeholder="Nom..."> 
                    </div>
                    <div class="col-md-4"> 
                        <input type="text" class="form-group form-control form-control-user" id="email" name="email" placeholder="Adresse Email...">
                        <input type="text" class="form-control form-control-user" id="num_flotte" name="num_flotte" placeholder="Numéro Flotte...">
                    </div>
        
                    <div class="col-md-4"> 
                        <input type="text" class="form-group form-control form-control-user" id="extension" name="extension" placeholder="Extension...">
                        <input type="text" class="form-group form-control form-control-user" id="lgn_direct" name="lgn_direct" placeholder="Ligne Directe...">
                    </div>
                </div>
        </fieldset>
        
        
        <fieldset class="form-group border border-primary rounded p-2">
            <legend  class="w-auto col-form-label"> Informations Professionnelles </legend>
                <div class="row">
                    <label for="asset_type" class="form-group col-md-2 col-form-label">Fonction : </label>
                    <div class="col-md-2">
                        <select class="form-control form-control-user" id="asset_type" name="fonction">
                            <option>Selectionner</option>
                            <option>Sr ICT Associate</option>
                            <option>ICT Specialist</option>
                            <option>Programme Officer</option>
                            <option>Parogramme Assitant</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <label for="asset_type" class="form-group col-md-2 col-form-label">Département : </label>
                    <div class="col-md-2">
                        <select class="form-control form-control-user" id="departement" name="departement">
                            @foreach ($section as $item)
                                <option value="{{$item->id_sect}}"> {{$item->nom_sect}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="asset_type" class="form-group col-md-2 col-form-label">Lieu d'Affectation : </label>
                    <div class="col-md-2">
                        <select class="form-control form-control-user" id="bureau" name="bureau">
                            @foreach ($bureau as $item)
                                <option value="{{$item->id}}"> {{$item->nom_bur}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">

                    </div>
                    <label for="asset_type" class="form-group col-md-2 col-form-label">Section : </label>
                    <div class="col-md-2">
                        <select class="form-control form-control-user" id="section" name="section">
                            @foreach ($section as $item)
                                <option value="{{$item->id}}"> {{$item->nom}}</option>
                            @endforeach
                        </select>
                    </div>
        </fieldset>
          
        <fieldset class="form-group border border-primary rounded p-2">
            <legend class="w-auto col-form-label"> Autres Informations </legend>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input type="radio" name="radio" id="staff" value="1" checked>
                            <label class="form-check-label" for="staff">Staff</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="radio" id="bcp" value="2">
                            <label class="form-check-label" for="bcp">BCP Member</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="radio" id="consultant" value="3">
                            <label class="form-check-label" for="consultant">Consultant</label>
                        </div>                    
                    </div>
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-user" id="num_telmob" name="num_telmob"  placeholder="Numéro Telmob...">
                        <input type="text" class="form-control form-control-user" id="num_thuraya" name="num_thuraya"  placeholder="Numéro Thuraya...">
                    </div>
                </div>
        </fieldset>

        <fieldset class="form-group border border-primary rounded p-2">
            <legend class="w-auto col-form-label"> Commentaires </legend>
            <textarea class="form-control" id="emp_comment" name="emp_comment" placeholder="Commentaires..." rows="3"></textarea>
        </fieldset>
        <br>
        <div class="form-group row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-succes">Enregistrer</button>
                <button type="reset" class="btn btn-primary btn-danger">Annuler</button>
            </div>
            <div class="col-md-4">
            </div>
        </div>
</form>

@endsection