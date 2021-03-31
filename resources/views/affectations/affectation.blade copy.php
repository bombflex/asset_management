@extends('layouts.admin')

@section('contenu') 
<div class="container table-responsive">
    <script>
        var exist = '{{Session::has('Ok_Message')}}';
        if(exist){
            bootbox.alert({
                message: "Effectué!",
                size: 'small'
            });
        }
    </script> 
<h3>Affectation du Matériel</h3>
    <button data-toggle="modal" data-target="#add_affect" class="btn btn-primary" id="createAffect">Nouveau</button>
        <br><br>
        <table class="table table-bordered data-table">

            <thead>
                <tr>
                    <th>Nom et Prénom(s)</th>
                    <th>Laptop</th>
                    {{-- <th>Description Laptop</th> --}}
                    {{-- <th>Serial Laptop</th> --}}
                    <th>Nom Laptop</th>
                 
                    <th>Radio VHF</th>
                    {{-- <th>Description Radio </th> --}}
                    {{-- <th>Serial Radio</th> --}}
                    <th>Callsign</th>
                 
                    <th>Thuraya</th>
                    {{-- <th>Description Thuraya</th> --}}
                    {{-- <th>Serial Thuraya</th> --}}
                    {{-- <th>Sim Thuraya</th> --}}
                    <th>Numéro Thuraya</th>
                 
                    {{-- <th>Commentaires</th> --}}
                    <th>Actions</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
</div>
{{-- Modal Nouvelle Affectation --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id="add_affect">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">Nouvelle Affectation</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{route('affectation.store')}}" method="POST">
                @csrf
                <div class="modal-body row">
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Utilisateur </legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <input type="hidden" class="form-group form-control form-control-user" id="id_emp" name="id_emp">   
                                    <input type="text" class="form-group form-control form-control-user" id="nom" name="nom" placeholder="Nom..." required>   
                                    <input type="text" class="form-group form-control form-control-user" id="fonction" name="fonction" placeholder="Fonction..." readonly> 
                                </div>
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="bureau" name="bureau" placeholder="Duty Station..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="departement" name="departement" placeholder="Département..." readonly> 
                                </div>
            
                            </div>
                    </fieldset>
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Laptop </legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="invent_lap" name="invent_lap"  placeholder="Numéro d'inventaire...">   
                                    <input type="text" class="form-group form-control form-control-user" id="nom_lap" name="nom_lap"  placeholder="Nom de L'ordinateur..."> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="desc_lap" name="desc_lap"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="serial_lap" name="serial_lap" placeholder="Numéro de Série..."readonly>   
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Radio </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="invent_vhf" name="invent_vhf"  placeholder="Numéro d'inventaire...">   
                                    <input type="text" class="form-group form-control form-control-user" id="callsign" name="callsign"  placeholder="CallSign..."> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="desc_vhf" name="desc_vhf"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="serial_vhf" name="serial_vhf" placeholder="Numéro de Série..."readonly> 
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2 " {{-- style="display: none" --}}>
                        <legend  class="w-auto col-form-label"> Thuraya </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="invent_thuraya" name="invent_thuraya"  placeholder="Numéro d'inventaire...">   
                                    <input type="text" class="form-group form-control form-control-user" id="sim_thuraya" name="sim_thuraya"  placeholder="Numero de la SIM..."> 
                                    <input type="text" class="form-group form-control form-control-user" id="num_tel" name="num_tel"  placeholder="Numero de Téléphone..."> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="desc_thuraya" name="desc_thuraya"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="serial_thuraya" name="serial_thuraya" placeholder="Numéro de Série..."readonly> 
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Commentaires </legend>
                            <textarea class="form-control" name="affect_comment" placeholder="Commentaires..." rows="3"></textarea>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button id="save_btn" type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal Nouvelle Affectation --}}
{{-- Modal Modifier Affectation --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id="edit_affect">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="m_modelHeading"></h5>              
                <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
                </button>
            </div>
            <form class="col" action="{{ route('affectation.update','asset_id') }}"  method="POST">
                @csrf
                @method('PUT') 
                <div class="modal-body row">
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Utilisateur </legend>
                            <div class="row">
                                <input type="hidden" id="m_affect_id" name="m_affect_id" > 
                                <div class="col-md-6"> 
                                    <input type="hidden" class="form-group form-control form-control-user" id="m_id_emp" name="m_id_emp">   
                                    <input type="text" class="form-group form-control form-control-user" id="m_nom" name="m_nom" placeholder="Nom..." readonly>   
                                    <input type="text" class="form-group form-control form-control-user" id="m_fonction" name="m_fonction" placeholder="Fonction..." readonly> 
                                </div>
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="m_bureau" name="m_bureau" placeholder="Duty Station..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="m_departement" name="m_departement" placeholder="Département..." readonly> 
                                </div>
            
                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Laptop </legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <input type="hidden" id="m_invent_lap_old" name="m_invent_lap_old" > 
                                    <input type="text" class="form-group form-control form-control-user" id="m_invent_lap" name="m_invent_lap"  placeholder="Numéro d'inventaire...">   
                                    <input type="text" class="form-group form-control form-control-user" id="m_nom_lap" name="m_nom_lap"  placeholder="Nom de L'ordinateur..."> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="m_desc_lap" name="m_desc_lap"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="m_serial_lap" name="m_serial_lap" placeholder="Numéro de Série..."readonly>   
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Radio </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="m_invent_vhf_old" name="m_invent_vhf_old" > 
                                    <input type="text" class="form-group form-control form-control-user" id="m_invent_vhf" name="m_invent_vhf"  placeholder="Numéro d'inventaire...">   
                                    <input type="text" class="form-group form-control form-control-user" id="m_callsign" name="m_callsign"  placeholder="CallSign..."> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="m_desc_vhf" name="m_desc_vhf"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="m_serial_vhf" name="m_serial_vhf" placeholder="Numéro de Série..."readonly> 
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12" {{-- style="display: none" --}}>
                        <legend  class="w-auto col-form-label"> Thuraya </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="m_invent_thuraya_old" name="m_invent_thuraya_old" > 
                                    <input type="text" class="form-group form-control form-control-user" id="m_invent_thuraya" name="m_invent_thuraya"  placeholder="Numéro d'inventaire..." >   
                                    <input type="text" class="form-group form-control form-control-user" id="m_sim_thuraya" name="m_sim_thuraya"  placeholder="Numero de la SIM..."> 
                                    <input type="text" class="form-group form-control form-control-user" id="m_num_tel" name="m_num_tel"  placeholder="Numero de Téléphone..."> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="m_desc_thuraya" name="m_desc_thuraya"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="m_serial_thuraya" name="m_serial_thuraya" placeholder="Numéro de Série..."readonly> 
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Commentaires </legend>
                            <textarea class="form-control" id="m_affect_comment" name="m_affect_comment"placeholder="Commentaires..." rows="3"></textarea>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- Fin Modal Modifier Affectation --}}
{{-- Modal Supprimer Affectation --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id='delete_affect'>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="d_modelHeading"></h5>              
                <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('affectation.destroy','affect_id') }}"  method="POST">
                @csrf
                @method('DELETE') 
                <div class="modal-body row">
                    <input type="hidden" id="d_affect_id" name="d_affect_id" > 
                    <p class="text-center" width="50px">Voulez vous vraiment supprimer?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">oui</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Supprimer Affectation --}}
{{-- Modal Detail Affectation --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id="view_affect">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="v_modelHeading"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="view_form" action= "{{ route('affectation.show','v_id_affect') }}" method="POST">
                @csrf
                @method('GET')
                <div class="modal-body row" id="view_affectation">
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Utilisateur </legend>
                            <div class="row">
                                <input type="hidden" id="v_affect_id" name="v_affect_id" > 
                                <div class="col-md-6"> 
                                    <input type="hidden" id="v_id_emp" name="v_id_emp">   
                                    <input type="hidden" id="v_email_emp" name="v_email_emp">   
                                    <input type="text" class="form-group form-control form-control-user" id="v_nom" name="v_nom" placeholder="Nom..." readonly>   
                                    <input type="text" class="form-group form-control form-control-user" id="v_fonction" name="v_fonction" placeholder="Fonction..." readonly> 
                                </div>
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_bureau" name="v_bureau" placeholder="Duty Station..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_departement" name="v_departement" placeholder="Département..." readonly> 
                                </div>
            
                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Laptop </legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <input type="hidden" id="v_invent_lap_old" name="v_invent_lap_old" > 
                                    <input type="text" class="form-group form-control form-control-user" id="v_invent_lap" name="v_invent_lap"  placeholder="Numéro d'inventaire..." readonly>   
                                    <input type="text" class="form-group form-control form-control-user" id="v_nom_lap" name="v_nom_lap"  placeholder="Nom de L'ordinateur..." readonly> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="v_desc_lap" name="v_desc_lap"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_serial_lap" name="v_serial_lap" placeholder="Numéro de Série..."readonly>   
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Radio </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="v_invent_vhf_old" name="v_invent_vhf_old" > 
                                    <input type="text" class="form-group form-control form-control-user" id="v_invent_vhf" name="v_invent_vhf"  placeholder="Numéro d'inventaire..." readonly>   
                                    <input type="text" class="form-group form-control form-control-user" id="v_callsign" name="v_callsign"  placeholder="CallSign..." readonly> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="v_desc_vhf" name="v_desc_vhf"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_serial_vhf" name="v_serial_vhf" placeholder="Numéro de Série..."readonly> 
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12" {{-- style="display: none" --}}>
                        <legend  class="w-auto col-form-label"> Thuraya </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="v_invent_thuraya_old" name="v_invent_thuraya_old" > 
                                    <input type="text" class="form-group form-control form-control-user" id="v_invent_thuraya" name="v_invent_thuraya"  placeholder="Numéro d'inventaire..." readonly>   
                                    <input type="text" class="form-group form-control form-control-user" id="v_sim_thuraya" name="v_sim_thuraya"  placeholder="Numero de la SIM..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_num_tel" name="v_num_tel"  placeholder="Numero de Téléphone..." readonly> 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="v_desc_thuraya" name="v_desc_thuraya"  placeholder="Description..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_serial_thuraya" name="v_serial_thuraya" placeholder="Numéro de Série..."readonly> 
                                </div>

                            </div>
                    </fieldset>
                    <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                        <legend  class="w-auto col-form-label"> Commentaires </legend>
                            <textarea class="form-control" id="v_affect_comment" name="v_affect_comment"placeholder="Commentaires..." rows="3" readonly></textarea>
                    </fieldset>
                </div>
                <div class="modal-footer" >
                    <button type="submit" class="btn btn-success">Envoyer</button>
                    <button type="button" id="download" class="btn btn-primary" data-href="{{ route('affectation.create') }}" data-id_af="$('#v_affect_id').val()">Télécharger</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Detail Affectation --}}
<script>
    /* Bootstrap did not support multiple modals at the same time. It is a Bootstrap Bug. Just add the below script for BS4. */
    $('body').on('hidden.bs.modal', function () {
        if($('.modal.show').length > 0)
        {
            $('body').addClass('modal-open');
        }
    });
</script>

<script>
          
    $("#add_affect").on('shown.bs.modal',function(){ 

        $("input#invent_lap").focusout(function(){
            var invent_num = $('#invent_lap').val();   
            var url = "{{ route('affectation.check','invent') }}";
            url = url.replace('invent', invent_num);
            
            
            $.get(url, function (data) {
                //var tab = data.length === 0;
                if (data.length != 0) {
                    bootbox.alert({
                    title: 'Attention !!', 
                    message: 'Le matériel : ' + data[0].inventory_num + ' - ' + data[0].asset_description + ', est déja attribué à '+ data[0].nom_emp +'.',
                    size: 'large'
                    });
                    console.log(data);
                    $("#invent_lap").val("");
                    $("#desc_lap").val("");
                    $("#serial_lap").val("");
                }     
            })
        });
        $("input#invent_vhf").focusout(function(){
            var invent_num = $('#invent_vhf').val();   
            var url = "{{ route('affectation.check','invent') }}";
            url = url.replace('invent', invent_num);
            $.get(url, function (data) {
                //var tab = data.length === 0;
                if (data.length != 0) {
                    bootbox.alert({
                    title: 'Attention !!', 
                    message: 'Le matériel : ' + data[0].inventory_num + ' - ' + data[0].asset_description + ', est déja attribué à '+ data[0].nom_emp +'.',
                    size: 'large'
                    });
                    console.log(data);
                    $("#invent_vhf").val("");
                    $("#desc_vhf").val("");
                    $("#serial_vhf").val("");
                }     
            })
        });
        $("input#invent_thuraya").focusout(function(){
            var invent_num = $('#invent_thuraya').val();   
            var url = "{{ route('affectation.check','invent') }}";
            url = url.replace('invent', invent_num);
            $.get(url, function (data) {
                //var tab = data.length === 0;
                if (data.length != 0) {
                    bootbox.alert({
                    title: 'Attention !!', 
                    message: 'Le matériel : ' + data[0].inventory_num + ' - ' + data[0].asset_description + ', est déja attribué à '+ data[0].nom_emp +'.',
                    size: 'large'
                    });
                    console.log(data);
                    $("#invent_thuraya").val("");
                    $("#desc_thuraya").val("");
                    $("#serial_thuraya").val("");
                }     
            })
        });

    });
    $("#edit_affect").on('shown.bs.modal',function(){
        l_inv_prev = $("#m_invent_lap").val();
        l_desk_prev = $("#m_desc_lap").val();
        l_ser_prev = $("#m_serial_lap").val();
        v_inv_prev = $("#m_invent_vhf").val();
        v_desk_prev = $("#m_desc_vhf").val();
        v_ser_prev = $("#m_serial_vhf").val();
        t_inv_prev = $("#m_invent_thuraya").val();
        t_desk_prev = $("#m_desc_thuraya").val();
        t_ser_prev = $("#m_serial_thuraya").val();
        
        $("input#m_invent_lap").focusout(function(){
            var invent_num = $('#m_invent_lap').val();   
            var url = "{{ route('affectation.check','invent') }}";
            url = url.replace('invent', invent_num);
            
            $.get(url, function (data) {
                //var tab = data.length === 0;
                if (data.length != 0) {
                    bootbox.alert({
                    title: 'Attention !!', 
                    message: 'Le matériel : ' + data[0].inventory_num + ' - ' + data[0].asset_description + ', est déja attribué à '+ data[0].nom_emp +'.',
                    size: 'large'
                    });
                    $("#m_invent_lap").val(l_inv_prev);
                    $("#m_desc_lap").val(l_desk_prev);
                    $("#m_serial_lap").val(l_ser_prev);
                }     
            })
            if (invent_num !== l_inv_prev) {
                $("#m_invent_lap_old").val(l_inv_prev);
                console.log(l_inv_prev);
            }
        });

        $("input#m_invent_vhf").focusout(function(){
            var invent_num = $('#m_invent_vhf').val();   
            var url = "{{ route('affectation.check','invent') }}";
            url = url.replace('invent', invent_num);
            $.get(url, function (data) {
                //var tab = data.length === 0;
                if (data.length != 0) {
                    bootbox.alert({
                    title: 'Attention !!', 
                    message: 'Le matériel : ' + data[0].inventory_num + ' - ' + data[0].asset_description + ', est déja attribué à '+ data[0].nom_emp +'.',
                    size: 'large'
                    });
                    $("#m_invent_vhf").val(v_inv_prev);
                    $("#m_desc_vhf").val(v_desk_prev);
                    $("#m_serial_vhf").val(v_ser_prev);
                }     
            })
            if (invent_num !== v_inv_prev) {
                $("#m_invent_vhf_old").val(v_inv_prev);
                console.log(v_inv_prev);
            }
        });
        $("input#m_invent_thuraya").focusout(function(){
            var invent_num = $('#m_invent_thuraya').val();   
            var url = "{{ route('affectation.check','invent') }}";
            url = url.replace('invent', invent_num);
            $.get(url, function (data) {
                //var tab = data.length === 0;
                if (data.length != 0) {
                    bootbox.alert({
                    title: 'Attention !!', 
                    message: 'Le matériel : ' + data[0].inventory_num + ' - ' + data[0].asset_description + ', est déja attribué à '+ data[0].nom_emp +'.',
                    size: 'large'
                    });
                    $("#m_invent_thuraya").val(t_inv_prev);
                    $("#m_desc_thuraya").val(t_desk_prev);
                    $("#m_serial_thuraya").val(t_ser_prev);
                }     
            })
            if (invent_num !== t_inv_prev) {
                $("#m_invent_vhf_old").val(t_inv_prev);
                console.log(t_inv_prev);
            }
        });
    }); 
            
        
</script>

<script type="text/javascript">
$( "input#nom" ).autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completeemp')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            console.log(data);
            response( data );
        }
        });
    },
    appendTo: "#add_affect",
    select: function (event, ui) {
        // Set selection
        $('#id_emp').val(ui.item.id); // display the selected text
        $('#nom').val(ui.item.label); // display the selected text
        $('#fonction').val(ui.item.value); // save selected id to input
        $('#bureau').val(ui.item.bur); // save selected id to input
        $('#departement').val(ui.item.dep); // save selected id to input
        return false;
    }
});

$( "input#invent_lap" ).autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completelaptop')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            console.log(data);
            response( data );
        }
        });
    },
    appendTo: "#add_affect",
    select: function (event, ui) {
        // Set selection
        $('#invent_lap').val(ui.item.label); // display the selected text
        $('#desc_lap').val(ui.item.value); // save selected id to input
        $('#serial_lap').val(ui.item.serial); // save selected id to input
        return false;
    }
});

$( "input#invent_vhf" ).autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completevhf')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            console.log(data);
            response( data );
        }
        });
    },
    appendTo: "#add_affect",
    select: function (event, ui) {
        // Set selection
        $('#invent_vhf').val(ui.item.label); // display the selected text
        $('#desc_vhf').val(ui.item.value); // save selected id to input
        $('#serial_vhf').val(ui.item.serial); // save selected id to input
        return false;
    }
});

$( "input#invent_thuraya").autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completethuraya')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            console.log(data);
            response( data );
        }
        });
    },
    appendTo: "#add_affect",
    select: function (event, ui) {
        // Set selection
        $('#invent_thuraya').val(ui.item.label); // display the selected text
        $('#desc_thuraya').val(ui.item.value); // save selected id to input
        $('#serial_thuraya').val(ui.item.serial); // save selected id to input
        return false;
    }
});
/* Edit */

$( "input#m_invent_lap" ).autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completelaptop')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            response( data );
        }
        });
    },
    appendTo: "#edit_affect",
    select: function (event, ui) {
        // Set selection
        $('#m_invent_lap').val(ui.item.label); // display the selected text
        $('#m_desc_lap').val(ui.item.value); // save selected id to input
        $('#m_serial_lap').val(ui.item.serial); // save selected id to input
        return false;
    }
});

$( "input#m_invent_vhf" ).autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completevhf')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            console.log(data);
            response( data );
        }
        });
    },
    appendTo: "#edit_affect",
    select: function (event, ui) {
        // Set selection
        $('#m_invent_vhf').val(ui.item.label); // display the selected text
        $('#m_desc_vhf').val(ui.item.value); // save selected id to input
        $('#m_serial_vhf').val(ui.item.serial); // save selected id to input
        return false;
    }
});

$( "input#m_invent_thuraya").autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completethuraya')}}",
        type: 'post',
        dataType: "json",
        data: {
            search: request.term
        },
        success: function( data ) {
            console.log(data);
            response( data );
        }
        });
    },
    appendTo: "#edit_affect",
    select: function (event, ui) {
        // Set selection
        $('#m_invent_thuraya').val(ui.item.label); // display the selected text
        $('#m_desc_thuraya').val(ui.item.value); // save selected id to input
        $('#m_serial_thuraya').val(ui.item.serial); // save selected id to input
        return false;
    }
});
</script>

<script type="text/javascript">
  $(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
        ajax: "{{ route('affectation.index') }}",

        columns: [
            {data: 'nom_emp', name: 'nom_emp',width: '250px', class: 'text-left'},
            {data: 'inv_laptop', name: 'inv_laptop'},
            // {data: 'desc_laptop', name: 'desc_laptop'},
            // {data: 'serial_laptop', name: 'serial_laptop',width: '150px', class: 'text-left'},
            {data: 'nom_laptop', name: 'nom_laptop',width: '150px', class: 'text-left'},
            {data: 'inv_radio', name: 'inv_radio',width: '150px', class: 'text-left'},
            // {data: 'desc_radio', name: 'desc_radio'},
            // {data: 'serial_radio', name: 'serial_radio',width: '250px', class: 'text-left'},
            {data: 'call_radio', name: 'call_radio'},
            {data: 'inv_thuraya', name: 'inv_thuraya',width: '150px', class: 'text-left'},
            // {data: 'desc_thuraya', name: 'desc_thuraya'},
            // {data: 'serial_thuraya', name: 'serial_thuraya'},
            /* {data: 'sim_thuraya', name: 'sim_thuraya'},*/
            {data: 'numero_thuraya', name: 'num_thuraya',width: '150px', class: 'text-left'}, 
            // {data: 'comment_affect', name: 'comment_affect'},
            {data: 'action', name: 'action', width: '150px', class: 'text-center', orderable: false, searchable: false},
        ]

    });

});
    $('body').on('click', '.editAffect', function () {
        var affect_id = $(this).data('id');
        //$('#view_form').html("action = "+url);
        $.get("{{ route('affectation.index') }}" +'/' + affect_id +'/edit', function (data) {
            $('#m_modelHeading').html("Modifier Affectation");
            $('#edit_affect').modal('show');
            $('#m_affect_id').val(affect_id);
            $('#m_id_emp').val(data[0].id_emp);
            $('#m_nom').val(data[0].nom_emp); 
            $('#m_fonction').val(data[0].fonction_emp); 
            $('#m_bureau').val(data[0].nom_bur); 
            $('#m_departement').val(data[0].nom_unite); 
            $('#m_invent_lap').val(data[0].inv_laptop); 
            $('#m_desc_lap').val(data[0].desc_laptop); 
            $('#m_nom_lap').val(data[0].nom_laptop); 
            $('#m_serial_lap').val(data[0].serial_laptop); 
            $('#m_invent_vhf').val(data[0].inv_radio); 
            $('#m_callsign').val(data[0].call_radio); 
            $('#m_desc_vhf').val(data[0].desc_radio); 
            $('#m_serial_vhf').val(data[0].serial_radio); 
            $('#m_invent_thuraya').val(data[0].inv_thuraya); 
            $('#m_sim_thuraya').val(data[0].sim_thuraya); 
            $('#m_num_tel').val(data[0].numero_thuraya); 
            $('#m_desc_thuraya').val(data[0].desc_thuraya); 
            $('#m_serial_thuraya').val(data[0].serial_thuraya);  
            $('#m_affect_comment').val(data[0].comment_affect);
        })
   });

   $('body').on('click', '.delAffect', function () {
      var d_affect_id = $(this).data('id');
        $('#d_modelHeading').html("Supprimer Affectation");
        $('#delete_affect').modal('show');
        $('#d_affect_id').val(d_affect_id);
        console.log(d_affect_id);
   });

   $('#download').click(function() {
        var affect_id = $('#v_affect_id').val();
        var url = "{{ route('affectation.create','query=id_affect') }}";
        url = url.replace('id_affect', affect_id);
        window.location.href = url;
        console.log(affect_id);
   });

   /* $('body').on('click', '.viewAffect', function () {
        var affect_id = $(this).data('id');
        var affect_emp = $(this).data('nom_emp');

        var url = "{{ route('affectation.show','id_affect') }}";
        url = url.replace('id_affect', affect_id);
    
        $('#view_affectation').html('<embed src="'+url+'"frameborder="0" width="100%" height="400px">');      
        $('#v_modelHeading').html("Décharge de : "+ affect_emp +"");
        $('#view_affect').modal('show');
        console.log(url);
    });
 */

   $('body').on('click', '.viewAffect', function () {
        var affect_id = $(this).data('id');
        /* var url = "{{ route('affectation.show','id_affect') }}";
            url = url.replace('id_affect', affect_id);
            $.get(url, function (data) { */
                $.get("{{ route('affectation.index') }}" +'/' + affect_id +'/edit', function (data) {
                $('#v_modelHeading').html("Visualiser Affectation");
                $('#view_affect').modal('show');
                $('#v_affect_id').val(affect_id);
                $('#v_id_emp').val(data[0].id_emp);
                $('#v_nom').val(data[0].nom_emp); 
                $('#v_fonction').val(data[0].fonction_emp); 
                $('#v_bureau').val(data[0].nom_bur); 
                $('#v_departement').val(data[0].nom_unite); 
                $('#v_email_emp').val(data[0].email); 
                $('#v_invent_lap').val(data[0].inv_laptop); 
                $('#v_desc_lap').val(data[0].desc_laptop); 
                $('#v_nom_lap').val(data[0].nom_laptop); 
                $('#v_serial_lap').val(data[0].serial_laptop); 
                $('#v_invent_vhf').val(data[0].inv_radio); 
                $('#v_callsign').val(data[0].call_radio); 
                $('#v_desc_vhf').val(data[0].desc_radio); 
                $('#v_serial_vhf').val(data[0].serial_radio); 
                $('#v_invent_thuraya').val(data[0].inv_thuraya); 
                $('#v_sim_thuraya').val(data[0].sim_thuraya); 
                $('#v_num_tel').val(data[0].numero_thuraya); 
                $('#v_desc_thuraya').val(data[0].desc_thuraya); 
                $('#v_serial_thuraya').val(data[0].serial_thuraya);  
                $('#v_affect_comment').val(data[0].comment_affect);
                console.log(data);
            }) 
    });
   /*  $('body').on('click', '.editAsset', function () {
      var m_asset_id = $(this).data('id');
      $.get("{{ route('affectation.index') }}" +'/' + m_asset_id +'/edit', function (data) {
        $('#e_modelHeading').html("Modifier Asset");
        $('#edit_asset').modal('show');
        $('#m_asset_id').val(data[0].id_asset);
        $('#type_id').val(data[0].id);
        $('#type_description').val(data[0].type_description);
        $('#asset_code').val(data[0].inventory_code);
        $('#asset_invent').val(data[0].inventory_num);
        $('#asset_desc').val(data[0].asset_description);
        $('#asset_serial').val(data[0].serial_num);
        $('#purch_order').val(data[0].asset_PO);
        $('#purch_order_date').val(data[0].PO_date);
        $('#asset_comment').val(data[0].asset_comment);
        
        console.log(data[0]);
      })
   });

    $('body').on('click', '.delAsset', function () {
      var d_asset_id = $(this).data('id');
      $.get("{{ route('asset.index') }}" +'/' + d_asset_id +'/edit', function (data) {
        $('#d_modelHeading').html("Supprimer Asset");
        $('#delete_asset').modal('show');
        $('#d_asset_id').val(data[0].id_asset);
        console.log(data[0]);
      })
   }); */
  

</script>

@endsection