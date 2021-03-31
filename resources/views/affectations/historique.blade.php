@extends('layouts.admin')

@section('contenu') 
<div class="table-responsive">
    <script>
        var exist = '{{Session::has('Ok_Message')}}';
        if(exist){
            bootbox.alert({
                message: "Effectué!",
                size: 'small'
            });
        }
    </script> 
<h3>Historique des Affectations du Matériel</h3>
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
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
</div>

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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>   
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
        ajax: "{{ route('historique.index') }}",

        columns: [
            {data: 'nom_emp', name: 'nom_emp',width: '200px', class: 'text-left'},
            {data: 'inv_laptop', name: 'inv_laptop',width: '100px', class: 'text-left'},
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
            {data: 'action', name: 'action', width: '50px', class: 'text-center', orderable: false, searchable: false},
        ]

    });

});


   $('body').on('click', '.viewAffect', function () {
        var affect_id = $(this).data('id');
        /* var url = "{{ route('affectation.show','id_affect') }}";
            url = url.replace('id_affect', affect_id);
            $.get(url, function (data) { */
                $.get("{{ route('historique.index') }}" +'/' + affect_id +'/edit', function (data) {
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

</script>

@endsection
