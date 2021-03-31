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
    <h3>Liste du Personnel</h3>
    <button data-toggle="modal" data-target="#add_employe" class="btn btn-primary">Nouveau</button>
    <button data-toggle="modal" data-target="#import_employe" class="btn btn-success">Importer</button>
    <a class="btn btn-warning" href="{{ route('export_staff') }}">Exporter</a>

    <div class="mt-5 table-responsive">
       {{--  <h5 class="mb-4">Liste du personnel</h5> --}}
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>email</th>
                    <th>Bureau</th>
                    <th>Section</th>
                    <th>Fonction</th>
                    <th>Extension</th>
                    <th>Num_flotte</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    {{-- Modal Nouveau Staff --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="add_employe">
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Nouveau Staff</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('employe.store')}}" method="POST">
                    @csrf
                    <div class="modal-body row">
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Informations Personnelles </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="capitalize form-group form-control form-control-user" id="nom" name="nom" placeholder="Nom..." required>   
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" class="lower form-group form-control form-control-user" id="email" name="email" placeholder="Adresse Email..." required>
                                        <input type="text" class="form-group form-control form-control-user" id="num_flotte" name="num_flotte" placeholder="Numéro Flotte...">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-group form-control form-control-user" id="extension" name="extension" placeholder="Extension...">
                                        <input type="text" class="form-group form-control form-control-user" id="lgn_direct" name="lgn_direct" placeholder="Ligne Directe..." readonly>
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Informations Professionnelles </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" class="capitalize form-group form-control form-control-user" id="fonction" name="fonction" placeholder="Fonction..." required > 
                                        <input type="text" class="form-group form-control form-control-user" id="unite" name="unite" placeholder="Unité..." required>
                                        <input type="hidden" class="form-group form-control form-control-user" id="unite_val" name="unite_val">
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" class="form-group form-control form-control-user" id="section" name="section" placeholder="Section..." readonly>
                                        <input type="text" class="form-group form-control form-control-user" id="bureau" name="bureau" placeholder="Duty of Station..." required > 
                                        <input type="hidden" class="form-group form-control form-control-user" id="bureau_val" name="bureau_val"> 
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend class="w-auto col-form-label"> Autres Informations </legend>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="radio" name="nature_emp" id="staff" value="1" checked>
                                            <label class="form-check-label" for="staff">Staff</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="nature_emp" id="bcp" value="2">
                                            <label class="form-check-label" for="bcp">BCP Member</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="nature_emp" id="consultant" value="3">
                                            <label class="form-check-label" for="consultant">Consultant</label>
                                        </div>
                                    </div> 
                    
                                    <div class="col-md-6">
                                        <input type="text" class="form-group form-control form-control-user" id="num_telmob" name="num_telmob"  placeholder="Numéro Telmob...">
                                        <input type="text" class="form-group form-control form-control-user" id="num_autre" name="num_autre"  placeholder="Autre Numéro...">
                                    </div>
                                </div>
                        </fieldset>
                        
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Commentaires </legend>
                                <textarea class="capitalize form-control" name="emp_comment" id="emp_comment" placeholder="Commentaires..." rows="3"></textarea>
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
    {{-- Fin Modal Nouveau Staff --}}
    {{-- Modal Modifier Staff --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="edit_employe">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="m_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('employe.update','m_id')}}" method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="modal-body row">
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Informations Personnelles </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-group form-control form-control-user" id="m_id" name="m_id">   
                                        <input type="text" class="capitalize form-group form-control form-control-user" id="m_nom" name="m_nom" placeholder="Nom..." required>   
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" class="lower form-group form-control form-control-user" id="m_email" name="m_email" placeholder="Adresse Email..." required>
                                        <input type="text" class="form-group form-control form-control-user" id="m_num_flotte" name="m_num_flotte" placeholder="Numéro Flotte...">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-group form-control form-control-user" id="m_extension" name="m_extension" placeholder="Extension...">
                                        <input type="text" class="form-group form-control form-control-user" id="m_lgn_direct" name="m_lgn_direct" placeholder="Ligne Directe..." readonly>
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Informations Professionnelles </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" class="form-group form-control form-control-user" id="m_fonction" name="m_fonction" placeholder="Fonction..." readonly> 
                                        <input type="text" class="form-group form-control form-control-user" id="m_unite" name="m_unite" placeholder="Unité..." readonly>
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" class="form-group form-control form-control-user" id="m_section" name="m_section" placeholder="Section..." readonly>
                                        <input type="text" class="form-group form-control form-control-user" id="m_bureau" name="m_bureau" placeholder="Duty of Station..." readonly> 
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend class="w-auto col-form-label"> Autres Informations </legend>
                                <div class="row ">                                        
                                    <div class="col-md-6">
                                        <input type="text" class="form-group form-control form-control-user" id="m_num_telmob" name="m_num_telmob"  placeholder="Numéro Telmob...">
                                        <input type="text" class="form-group form-control form-control-user" id="m_num_autre" name="m_num_autre"  placeholder="Autre Numéro...">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-group form-control form-control-user" id="nature_emp" name="nature_emp"  placeholder="Nature Staff..." readonly>
                                        <div class="form-check form-switch">
                                            <input type="hidden" id="statut" name="statut"> 
                                            <input class="form-check-input" type="checkbox" id="check">
                                            <label class="form-check-label" for="check">Actif</label>
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                        
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Commentaires </legend>
                                <textarea class="capitalize form-control" name="m_emp_comment" id="m_emp_comment" placeholder="Commentaires..." rows="3"></textarea>
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
    {{-- Fin Modal Modifier Staff --}}
    {{-- Modal View Staff --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="view_employe">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="v_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
            
                <div class="modal-body row">
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Informations Personnelles </legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" class="col form-group form-control form-control-user" id="v_id" name="v_id">   
                                    <input type="text" class="col form-group form-control form-control-user" id="v_nom" name="v_nom" placeholder="Nom..." readonly>   
                                </div>
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_email" name="v_email" placeholder="Adresse Email..." readonly>
                                    <input type="text" class="form-group form-control form-control-user" id="v_nuv_flotte" name="v_nuv_flotte" placeholder="Numéro Flotte..." readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="v_extension" name="v_extension" placeholder="Extension..." readonly>
                                    <input type="text" class="form-group form-control form-control-user" id="v_lgn_direct" name="v_lgn_direct" placeholder="Ligne Directe..." readonly>
                                </div>
                            </div>
                    </fieldset>
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Informations Professionnelles </legend>
                            <div class="row">
                                <div class="col-md-12">
                                </div>
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_fonction" name="v_fonction" placeholder="Fonction..." readonly> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_unite" name="v_unite" placeholder="Unité..." readonly>
                                </div>
                                <div class="col-md-6"> 
                                    <input type="text" class="form-group form-control form-control-user" id="v_section" name="v_section" placeholder="Section..." readonly>
                                    <input type="text" class="form-group form-control form-control-user" id="v_bureau" name="v_bureau" placeholder="Duty of Station..." readonly> 
                                </div>
                            </div>
                    </fieldset>
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend class="w-auto col-form-label"> Autres Informations </legend>
                            <div class="row ">                                        
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="v_nuv_telmob" name="v_nuv_telmob"  placeholder="Numéro Telmob..." readonly>
                                    <input type="text" class="form-group form-control form-control-user" id="v_nuv_autre" name="v_nuv_autre"  placeholder="Autre Numéro..." readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-group form-control form-control-user" id="v_nature_emp" name="v_nature_emp"  placeholder="Nature Staff..." readonly>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="v_check" readonly>
                                        <label class="form-check-label" for="check">Actif</label>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                    
                    <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                        <legend  class="w-auto col-form-label"> Commentaires </legend>
                            <textarea class="form-control" name="v_emp_comment" id="v_emp_comment" placeholder="Commentaires..." rows="3" readonly></textarea>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin Modal View Staff --}}
    {{-- Modal Import Staff --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="import_employe">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title">Importation de Données</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('import_staff') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-md-12 form-group form-control-user">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input " id="file" name="file">
                                <label class="custom-file-label" for="file">Selectioner</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Importer Données</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin Modal View Staff --}}
</div>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script type="text/javascript">
 $(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $( "input#unite" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
            url:"{{route('completeunite')}}",
            type: 'post',
            dataType: "json",
            data: {
                _token: CSRF_TOKEN,
                search: request.term
            },
            success: function( data ) {
                console.log(data);
                response( data );
            }
            });
        },
        appendTo: "#add_employe",
        select: function (event, ui) {
            // Set selection
            $('#unite').val(ui.item.label); // display the selected text
            $('#unite_val').val(ui.item.value); // save selected id to input
            $('#section').val(ui.item.section); // save selected id to input
            return false;
        }
    });
    $( "input#bureau" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
            url:"{{route('completebureau')}}",
            type: 'post',
            dataType: "json",
            data: {
                _token: CSRF_TOKEN,
                search: request.term
            },
            success: function( data ) {
                console.log(data);
                response( data );
            }
            });
        },
        appendTo: "#add_employe",
        select: function (event, ui) {
            // Set selection
            $('#bureau').val(ui.item.label); // display the selected text
            $('#bureau_val').val(ui.item.value); // save selected id to input
            return false;
        }
    });
});
    $("#extension,#m_extension").focusout(function(){
        var str = $(this).val();
        var prefix = str.substring(0, 2);
        switch(prefix) {
            case "07":
                lign_dir = "2549"+str;
                break;
            case "11":
                lign_dir = "2549"+str;
                break;
            case "15":
                lign_dir = "2532"+str;
                break;
            default:
                lign_dir = "";
        }
        $("input#lgn_direct").val(lign_dir);
        $("input#m_lgn_direct").val(lign_dir);
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
          ajax: "{{ route('employe.index') }}",
          columns: [
              {data: 'nom_emp', name: 'nom_emp',width: '200px', class: 'text-left'},
              {data: 'email', name: 'email',width: '150px', class: 'text-left'},
              {data: 'nom_bur', name: 'nom_bur',width: '150px', class: 'text-left'},
              {data: 'nom_unite', name: 'unite',width: '200px', class: 'text-left'},
              {data: 'fonction_emp', name: 'fonction_emp',width: '250px', class: 'text-left'},
              {data: 'extension_emp', name: 'extension_emp'},
              {data: 'num_flotte', name: 'num_flotte'},
              {data: 'action', name: 'action', width: '150px', class: 'text-center',  orderable: false, searchable: false},
          ]
      });
    });

      $('body').on('click', '.editEmploye', function () {
      var emp_id = $(this).data('id');
      $.get("{{ route('employe.index') }}" +'/' + emp_id +'/edit', function (data) {
        $('#m_modelHeading').html("Modifier Staff");
        $('#edit_employe').modal('show');
        $('#m_id').val(emp_id);
        $('#m_nom').val(data[0].nom_emp);
        $('#m_email').val(data[0].email);
        $('#m_num_flotte').val(data[0].num_flotte);
        $('#m_extension').val(data[0].extension_emp);
        $('#m_lgn_direct').val(data[0].ligne_direct);
        $('#m_fonction').val(data[0].fonction_emp);
        $('#m_unite').val(data[0].nom_unite);
        $('#m_section').val(data[0].nom_sect);
        $('#m_bureau').val(data[0].nom_bur);
        $('#nature_emp').val(data[0].nature);
        $('#m_num_telmob').val(data[0].num_telmob);
        $('#m_num_autre').val(data[0].num_autre);
        $('#m_emp_comment').val(data[0].Comment_emp);
        
        if (data[0].statut_emp === 1) {
            $('#check').prop('checked', true);
            $('#statut').val(1);
        }
        else {
            $('#check').prop('checked', false);
            $('#statut').val(0);
        }
        $('#check').change(function(){
            if ($("input[type=checkbox]").is( ":checked")) { 
                $('#statut').val(1);
            } else { 
                $('#statut').val(0);
            } 
        });

      })
    });

      $('body').on('click', '.viewEmploye', function () {
      var emp_id = $(this).data('id');
      $.get("{{ route('employe.index') }}" +'/' + emp_id +'/edit', function (data) {
        $('#v_modelHeading').html("Visualiser Informations");
        $('#view_employe').modal('show');
        $('#v_id').val(emp_id);
        $('#v_nom').val(data[0].nom_emp);
        $('#v_email').val(data[0].email);
        $('#v_nuv_flotte').val(data[0].num_flotte);
        $('#v_extension').val(data[0].extension_emp);
        $('#v_lgn_direct').val(data[0].ligne_direct);
        $('#v_fonction').val(data[0].fonction_emp);
        $('#v_unite').val(data[0].nom_unite);
        $('#v_section').val(data[0].nom_sect);
        $('#v_bureau').val(data[0].nom_bur);
        $('#v_nature_emp').val(data[0].nature);
        $('#v_nuv_telmob').val(data[0].num_telmob);
        $('#v_nuv_autre').val(data[0].num_autre);
        $('#v_emp_comment').val(data[0].Comment_emp);
        
        if (data[0].statut_emp === 1) {
            $('#v_check').prop('checked', true);
        }
        else {
            $('#v_check').prop('checked', false);
        }
        /* $('#v_check').change(function(){
            if ($("input[type=checkbox]").is( ":checked")) { 
                $('#v_statut').val(1);
            } else { 
                $('#v_statut').val(0);
            } 
        }); */

      })
    });


  </script>

@endsection
