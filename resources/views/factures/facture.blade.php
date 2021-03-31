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
    <h3>Liste des Factures</h3>
    <button data-toggle="modal" data-target="#add_facture" class="btn btn-primary" id="createFact">Nouveau</button>
        <br><br>
        <table class="table table-bordered data-table" id="facture">

            <thead>
                <tr>
                    <th>Prestataire</th>
                    <th>Numéro</th>
                    <th>Objet</th>
                    <th>date</th>
                    <th>Montant</th>
                    {{-- <th>Commentaires</th> --}}
                    <th>Actions</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
</div>  
    {{-- Modal Detail facture --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="view_facture">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="v_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body row" id="view_fact">
{{--                     <embed id="view_fact" src="" type="">
 --}}                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin Modal Detail facture --}}
    {{-- Modal Nouvelle facture --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="add_facture">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Nouvelle facture</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('facture.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-md-12">
                            <input type="hidden" class="form-group form-control form-control-user" id="id_prest" name="id_prest">   
                            <input type="text" class="form-group form-control form-control-user" id="prest" name="prest" placeholder="Prestataire..." required>   
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-group form-control form-control-user" id="num_fact" name="num_fact" placeholder="Numéro Facture..." required> 
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-group form-control form-control-user" id="date_fact" name="date_fact" required>                            
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-group form-control form-control-user" id="obj_fact" name="obj_fact" placeholder="Objet Facture..." required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-user" id="mont_fact" name="mont_fact" placeholder="Montant Facture..." required> 
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" id="devise" name="devise">
                                @foreach ($devises as $item)
                                    <option value="{{$item->taux}}"> {{$item->code}}</option>
                                @endforeach
                            </select>                            
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-group form-control form-control-user" id="mont_fact_cfa" name="mont_fact_cfa" placeholder="Montant Facture CFA..." readonly> 
                        </div>
                          
                        <div class="col-md-12 form-group form-control-user">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input " id="fact_prest" name="file">
                                <label class="custom-file-label" for="fact_prest">Selectioner</label>
                              </div>
                        </div>

                        <div class="col-md-6 form-group form-control-user">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check_transmission">
                                <label class="form-check-label" for="check_transmission">Transmise à Administration </label>
                            </div>
                        </div>
                        <div class="col-md-6" id="dvDate" style="display: none">
                            <input type="date" class="form-control form-control-user" id="date_trans" name="date_trans">                            
                        </div>
                        
                        <div class="col-md-12">
                            <textarea class="form-control" id="fact_comment" name="fact_comment" placeholder="Commentaires..." rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin Modal Nouvelle facture --}}
    {{-- Modal Modifier facture --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="m_edit_facture">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="m_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('facture.update','asset_id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row">
                        <div class="col-md-12">
                            <input type="hidden" class="form-group form-control form-control-user" id="m_id_fact" name="m_id_fact">   
                            <input type="hidden" class="form-group form-control form-control-user" id="m_id_prest" name="m_id_prest">   
                            <input type="text" class="form-group form-control form-control-user" id="m_prest" name="m_prest" placeholder="Prestataire...">   
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-group form-control form-control-user" id="m_num_fact" name="m_num_fact" placeholder="Numéro Facture..."> 
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-group form-control form-control-user" id="m_date_fact" name="m_date_fact">                            
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-group form-control form-control-user" id="m_obj_fact" name="m_obj_fact" placeholder="Objet Facture...">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-user" id="m_mont_fact" name="m_mont_fact" placeholder="Montant Facture..."> 
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" id="m_devise" name="m_devise">
                                @foreach ($devises as $item)
                                    <option value="{{$item->taux}}"> {{$item->code}}</option>
                                @endforeach
                            </select>                            
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-group form-control form-control-user" id="m_mont_fact_cfa" name="m_mont_fact_cfa" placeholder="Montant Facture CFA..." readonly required> 
                        </div>
                        <div class="col-md-12 form-group form-control-user">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input " id="m_fact_prest" name="file">
                                <label class="custom-file-label" for="m_fact_prest">Selectioner</label>
                              </div>
                        </div>
                        <div class="col-md-6 form-group form-control-user">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="m_check_transmission">
                                <label class="form-check-label" for="m_check_transmission">Transmise à Administration </label>
                            </div>
                        </div>
                        <div class="col-md-6" id="m_dvDate" style="display: none">
                            <input type="date" class="form-control form-control-user" id="m_date_trans" name="m_date_trans">                            
                        </div>
                        
                        <div class="col-md-12">
                            <textarea class="form-control" id="m_fact_comment" name="m_fact_comment" placeholder="Commentaires..." rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin Modal Modifier facture --}}
{{-- Modal Supprimer facture --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id='delete_facture'>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="d_modelHeading"></h5>              
                <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('facture.destroy','fact_id') }}"  method="POST">
                @csrf
                @method('DELETE') 
                <div class="modal-body row">
                    <input type="hidden" class="form-group form-control form-control-user" id="d_fact_id" name="d_fact_id" > 
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

{{-- Fin Modal Supprimer facture --}}
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script>
    $(function () {
        $("#check_transmission, #m_check_transmission").click(function () {
            if ($(this).is(":checked")) {
                $("#dvDate").show();
                $("#m_dvDate").show();
            } else {
                $("#dvDate").hide();
                $("#date_trans").val('');
                $("#m_dvDate").hide();
                $("#m_date_trans").val('');
            }
        });
    });
</script>

<script>
    $("#devise").focusout(function(){
            var mnt = $('#mont_fact').val();   
            var taux = $('#devise').val();
            var mnt_cfa = mnt * taux; 
            $('#mont_fact_cfa').val(mnt_cfa);
            console.log(mnt);
            console.log(taux);
            console.log(mnt_cfa);
        });
    $("#m_devise").focusout(function(){
            var mnt = $('#m_mont_fact').val();   
            var taux = $('#m_devise').val();
            var mnt_cfa = mnt * taux; 
            $('#m_mont_fact_cfa').val(mnt_cfa);
        });
</script>
<script type="text/javascript">
$( "input#prest" ).autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completeprest')}}",
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
    appendTo: "#add_facture",
    select: function (event, ui) {
        // Set selection
        $('#id_prest').val(ui.item.value); // display the selected text
        $('#prest').val(ui.item.label); // display the selected text
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

    var table = $('.data-table#facture').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
        "autoWidth": false,
        ajax: "{{ route('facture.index') }}",

        columns: [
            {data: 'nom_prest', name: 'nom_prest'},
            {data: 'num_fact', name: 'num_fact'},
            {data: 'objet_fact', name: 'objet_fact',width: '200px', class: 'text-left'},
            {data: 'date_fact', name: 'date_fact',width: '100px', class: 'text-left'},
            {data: 'montant_fact_cfa', name: 'montant_fact_cfa',width: '100px', class: 'text-left'},
            // {data: 'comment_fact', name: 'comment_fact',width: '100px', class: 'text-left'},
            {data: 'action', name: 'action', width: '150px', class: 'text-center', orderable: false, searchable: false},
        ]

    });
    $('body').on('click', '.viewFacture', function () {
        var nom_fact = $(this).data('nom_fact');
        var num_fact = $(this).data('num_fact');
        var fact_id = $(this).data('id');

        if (nom_fact === "") {
            bootbox.alert({
                message: "Aucune facture existante !!",
                size: 'small'
            });
        }
        else {
            var url = "{{ asset('storage/uploads/facture') }}";
            url = url.replace('facture', nom_fact);
        
            $('#view_fact').html('<embed src="'+url+'"frameborder="0" width="100%" height="400px">');      
            $('#v_modelHeading').html("Visualiser Facture N° : "+ num_fact +"");
            $('#view_facture').modal('show');
        /*  $('#view_fact').append('<embed src="'+url+'"frameborder="0" width="100%" height="400px">'); */         
            //$('#view_fact').html("<embed src={{ asset('storage/uploads/facture') }}")
            console.log(url);
        }
    });

    $('body').on('click', '.editFacture', function () {
      var fact_id = $(this).data('id');
      $.get("{{ route('facture.index') }}" +'/' + fact_id +'/edit', function (data) {
        $('#m_modelHeading').html("Modifier facture");
        $('#m_edit_facture').modal('show');
        $('#m_id_fact').val(fact_id);
        $('#m_id_prest').val(data[0].id_prest);
        $('#m_prest').val(data[0].nom_prest);
        $('#m_num_fact').val(data[0].num_fact); 
        $('#m_obj_fact').val(data[0].objet_fact); 
        $('#m_date_fact').val(data[0].date_fact); 
        $('#m_mont_fact_cfa').val(data[0].montant_fact_cfa); 
        //$('#m_fact_prest').val(data[0].nom_fact); 
        $('#m_fact_comment').val(data[0].comment_fact); 
        $('#m_date_trans').val(data[0].date_trans); 

        if (data[0].date_trans !== null && data[0].date_trans !== '') {
            $('#m_check_transmission').prop('checked', true);
            $("#m_dvDate").show();
        }
        else {
            $('#m_check_transmission').prop('checked', false);
            $("#m_dvDate").hide();
        }
       
        console.log(data[0]);
      }) 
   });

   $('body').on('click', '.delFacture', function () {
      var fact_id = $(this).data('id');
        $('#d_modelHeading').html("Supprimer Facture");
        $('#delete_facture').modal('show');
        $('#d_fact_id').val(fact_id);
        console.log(data[0]);
   });

   
  });

</script>

@endsection
