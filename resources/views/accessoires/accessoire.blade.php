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
    <h3>Fourniture d'Accessoire</h3>
    <button data-toggle="modal" class="btn btn-success" id="create_affect">Nouveau</button>
    <button data-toggle="modal" class="btn btn-primary" id="add_access" >+Accessoires</button>
    <button data-toggle="modal" class="btn btn-warning" id="liste_access">Stock </button>
    <br><br>
    <table class="table table-bordered data-table">

        <thead>
            <tr>
                <th>Nom et Prénom(s)</th>
                <th>Description</th>
                <th>Quantité</th>                
                <th>Date</th>
                <th>Commentaire</th>
            </tr>

        </thead>
        <tbody>
        </tbody>
    </table>

    {{-- Modal Nouvel Accessoire --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="access_add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="a_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('accessoire.store')}}" method="POST">
                    @csrf
                    <div class="modal-body row">
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Informations </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-group form-control form-control-user" name="access_desc"  placeholder="Description..." required> 
                                        <input type="text" class="form-group form-control form-control-user" id="acces_qte" name="acces_qte"  placeholder="Quantité..." required> 
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Commentaires </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="access_comment" placeholder="Commentaires..." rows="3"></textarea>
                                    </div>
                                </div>
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
    {{-- Fin Modal Nouvel Accessoire --}}

    {{-- Modal Modifier Accessoire --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="access_edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="e_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('accessoire.update','access_id')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row">
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Informations </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" id="m_id_access" name="m_id_access">   
                                        <input type="text" class="form-group form-control form-control-user" id="access_desc" name="access_desc"  placeholder="Description..." required> 
                                        <input type="text" class="form-group form-control form-control-user" id="e_acces_qte" name="acces_qte"  placeholder="Quantité..." required> 
                                    </div>
                                </div>
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
    {{-- Fin Modal Modifier Accessoire --}}

    {{-- Modal Nouvelle Affectation --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="add_affect">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="n_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('fourniture.store')}}" method="POST">
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
                            <legend  class="w-auto col-form-label"> Accessoire </legend>
                                <div class="row">
                                    <div class="col-md-4"> 
                                        <input type="hidden" id="id_access" name="id_access">   
                                        <input type="text" class="form-group form-control form-control-user" id="desc_access" name="desc_access"  placeholder="Description..." required>   
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-group form-control form-control-user" id="qte_acces" name="qte_acces"  placeholder="Quantité..." required> 
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" class="form-group form-control form-control-user" id="date_acces" name="date_acces"  placeholder="Date..." required> 
                                    </div>

                                </div>
                        </fieldset>
                        
                        <fieldset class="col-md-12 form-group border border-primary rounded p-2">
                            <legend  class="w-auto col-form-label"> Commentaires </legend>
                                <textarea class="form-control" name="access_comment" id="access_comment" placeholder="Commentaires..." rows="3"></textarea>
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
    {{-- Fin Modal Nouvelle Affectation --}}
    </div>

    {{-- Modal Liste Accessoire --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id="list_access">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="l_modelHeading"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Qté Totale</th>
                            <th>Stock</th>
                        </tr>
        
                    </thead>
                    <tbody>
                        @foreach ($accessoires as $item)
                        <tr>
                            <td >{{$item->access_description}}</td>
                            <td >{{$item->access_quantite}}</td>
                            <td >{{$item->access_stock}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
            </div>

            <div class="modal-footer">
                <button type="submit" id="add_stock" class="btn btn-success">Ajouter Stock</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
{{-- Fin Modal Liste Accessoire --}}

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
        ajax: "{{ route('fourniture.index') }}",

        columns: [
            {data: 'nom_emp', name: 'nom_emp',width: '250px', class: 'text-left'},
            {data: 'access_description', name: 'access_description',width: '250px', class: 'text-left'},
            {data: 'quantite', name: 'quantite',width: '50px', class: 'text-left'},
            {data: 'date_four', name: 'date_four',width: '100px', class: 'text-left'},
            {data: 'comment_four', name: 'comment_four',width: '150px', class: 'text-left'},
        ]

    });

});

</script>

<script>
$('#liste_access').click(function () {
    var url = "{{ route('fourniture.show','id') }}";
    //url = url.replace('id_affect', affect_id);
    $.get(url, function (data) {
        $('#l_modelHeading').html("Liste des Accessoires");
        $('#list_access').modal('show');
        $('#add_stock').click(function (){
            $('#list_access').modal('hide');
            $('#access_edit').modal('show');
            $('#e_modelHeading').html("Augmenter le Stock");
        });
    });
    
});

$('#create_affect').click(function () {
    $('#n_modelHeading').html("Fournir Accessoires");
    $('#add_affect').modal('show');
});

$('#add_access').click(function () {
    $('#a_modelHeading').html("Ajouter Accessoire");
    $('#access_add').modal('show');
});

$("input#nom").autocomplete({
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

$("input#desc_access").autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completeaccess')}}",
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
        $('#desc_access').val(ui.item.label); // display the selected text
        $('#id_access').val(ui.item.value); // save selected id to input
        return false;
    }
});
$("input#access_desc").autocomplete({
    source: function( request, response ) {
        // Fetch data
        $.ajax({
        url:"{{route('completeaccess')}}",
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
    appendTo: "#access_edit",
    select: function (event, ui) {
        // Set selection
        $('#access_desc').val(ui.item.label); // display the selected text
        $('#m_id_access').val(ui.item.value); // save selected id to input
        return false;
    }
});

$("input#qte_acces").focusout(function(){
    var id_access = $('#id_access').val();   
    var quantite = $('#qte_acces').val();   
    var url = "{{ route('fourniture.check','id') }}";
    url = url.replace('id', id_access);
    $.get(url, function (data) {
        console.log(data[0].access_stock);
        //var tab = data.length === 0;
        if (quantite < 0 ) {
            bootbox.alert({
            title: 'Attention !!', 
            message: 'Valeur incorrecte !',
            size: 'small'
            });
        }
        else
        if (quantite > data[0].access_stock) {
            bootbox.alert({
            title: 'Attention !!', 
            message: 'Le stock de matériel est insuffisant! Stock actuel : ' + data[0].access_stock,
            size: 'small'
            });
        }     
    })
});
$("input#acces_qte, input#e_acces_qte").focusout(function(){
    var quantite = $('#acces_qte').val();   
        if (quantite < 0 ) {
            bootbox.alert({
            title: 'Attention !!', 
            message: 'Valeur incorrecte !',
            size: 'small'
            });
            $("#acces_qte").val("");
            $("#e_acces_qte").val("");
        }
});
</script>


@endsection
