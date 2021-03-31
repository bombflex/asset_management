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
      <h3>Désaffectation de Matériel</h3>
        <table class="table table-bordered data-table">

            <thead>
                <tr>
                    <th># Inventaire</th>
                    {{-- <th>Type</th> --}}
                    <th>Description</th>
                    <th># de Série</th>
                    <th>Nom et Prénom(s)</th>
                    <th>Fonction</th>
                    {{-- <th>Date</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
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
                <form {{-- action="{{ route('desaffectation.destroy','affect_id') }}" --}}  method="POST">
                    @csrf
                    @method('DELETE') 
                    <div class="modal-body row">
                        <input type="hidden" id="d_affect_id" name="d_affect_id" > 
                        <input type="hidden" id="d_affect_type" name="d_affect_type" > 
                        <input type="hidden" id="d_affect_inv" name="d_affect_inv" > 
                        <p class="text-center" width="50px">Voulez vous vraiment désaffecter?</p>
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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="v_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="DelForm" action="{{ route('desaffectation.destroy','asset_id') }}"  method="POST">
                    @csrf
                    @method('DELETE') 
                    <div class="modal-body row" id="view_desaffectation">
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Asset </legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" id="v_affect_type" name="v_affect_type" > 
                                        <input type="hidden" id="v_asset_id" name="v_asset_id" > 
                                        <input type="hidden" id="v_affect_id" name="v_affect_id" > 
                                        <input type="text" class="form-group form-control form-control-user" name="v_asset_invent" id="v_asset_invent" placeholder="Numéro d'Inventaire..." readonly> 
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-group form-control form-control-user" name="v_asset_desc" id="v_asset_desc" placeholder="Description..." readonly> 
                                        <input type="text" class="form-group form-control form-control-user"  name="v_asset_serial" id="v_asset_serial" placeholder="Numéro de Serie..." readonly> 
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-group form-control form-control-user"  name="v_purch_order" id="v_purch_order" placeholder="Purchase Order..." readonly> 
                                        <input type="date" class="form-group form-control form-control-user"  name="v_purch_order_date" id="v_purch_order_date" readonly> 
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Utilisateur </legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="col form-group form-control form-control-user" id="v_nom" name="v_nom" placeholder="Nom..." readonly>   
                                    </div>
                                    <div class="col-md-4"> 
                                        <input type="text" class="form-group form-control form-control-user" id="v_fonction" name="v_fonction" placeholder="Fonction..." readonly> 
                                        <input type="text" class="form-group form-control form-control-user" id="v_unite" name="v_unite" placeholder="Unité..." readonly>
                                    </div>
                                    <div class="col-md-4"> 
                                        <input type="text" class="form-group form-control form-control-user" id="v_section" name="v_section" placeholder="Section..." readonly>
                                        <input type="text" class="form-group form-control form-control-user" id="v_bureau" name="v_bureau" placeholder="Duty of Station..." readonly> 
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Affectation </legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="col form-group form-control form-control-user" id="v_type_description" name="v_type_description" placeholder="Type..." readonly>   
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="date" class="form-group form-control form-control-user"  name="v_affect_date" id="v_affect_date" readonly> 
                                    </div>
                                </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer" >
                        <button type="submit" id="desact" class="btn btn-warning desact">Désaffecter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    {{-- Fin Modal Detail Affectation --}}
    
</div>

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
    $('#desact').click(function(event){
        event.preventDefault();
        displaySavePromptMessage();
        function displaySavePromptMessage() {
            bootbox.confirm({
                message: "Voulez vous vraiment désaffecter?",
                buttons: {
                    confirm: {
                        label: 'Oui',
                        className: 'btn-warning'
                    },
                    cancel: {
                        label: 'Non',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result === true ) {
                        $('#DelForm').submit();
                    }
                }
            });
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
        ajax: "{{ route('desaffectation.index') }}",

        columns: [
            {data: 'inventory_num', name: 'inventory_num',width: '100px', class: 'text-left'},
            /* {data: 'type_description', name: 'type_description',width: '100px', class: 'text-left'}, */
            {data: 'asset_description', name: 'asset_description',width: '150px', class: 'text-left'},
            {data: 'serial_num', name: 'serial_num',width: '100px', class: 'text-left'},
            {data: 'nom_emp', name: 'nom_emp',width: '200px', class: 'text-left'},
            {data: 'fonction_emp', name: 'fonction_emp',width: '150px', class: 'text-left'},
            /* {data: 'affect_date', name: 'affect_date',width: '100px', class: 'text-left'}, */
            {data: 'action', name: 'action', class: 'text-center', orderable: false, searchable: false},
        ]

    });

});

   $('body').on('click', '.viewbtn', function () {
        var asset_id = $(this).data('id');
        var affect_type = $(this).data('asset');
        var affect_emp = $(this).data('nom_emp');

        $.get("{{ route('desaffectation.index') }}" +'/' + asset_id +'/edit', function (data) {
        $('#v_modelHeading').html(data[0].asset_description + " - "+ affect_emp +"");
        $('#view_affect').modal('show');

        $('#v_affect_type').val(affect_type);
        $('#v_asset_id').val(asset_id);
        $('#v_affect_id').val(data[0].affect_id);
        $('#v_asset_invent').val(data[0].inventory_num);
        $('#v_asset_desc').val(data[0].asset_description);
        $('#v_asset_serial').val(data[0].serial_num);
        $('#v_purch_order').val(data[0].asset_PO);
        $('#v_purch_order_date').val(data[0].PO_date);

        $('#v_nom').val(data[0].nom_emp);
        $('#v_fonction').val(data[0].fonction_emp);
        $('#v_unite').val(data[0].nom_unite);
        $('#v_section').val(data[0].nom_sect);
        $('#v_bureau').val(data[0].nom_bur);

        $('#v_type_description').val(data[0].type_description);
        $('#v_affect_date').val(data[0].affect_date);
        
        console.log(asset_id);

        })
        
        /* $('#desact').click(function(){
            window.confirm("sometext");
            if (confirm("Press a button!")) {
                txt = "You pressed OK!";
            } else {
                txt = "You pressed Cancel!";
            }
                
        }); */
        
    });


</script>

@endsection
