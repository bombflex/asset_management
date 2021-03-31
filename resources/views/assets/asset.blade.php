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

    <h3>Liste du Matériel</h3>

    <button data-toggle="modal" class="btn btn-primary" id="createAsset">Nouveau</button>
    <button data-toggle="modal" data-target="#import_asset" class="btn btn-success">Importer</button>
    <a class="btn btn-warning" href="{{ route('export_asset') }}">Exporter</a>
        <br><br>
        <table class="table table-bordered data-table">

            <thead>
                <tr>
                    <th>Type</th>
                    <th>Numéro d'Inventaire</th>
                    <th>Description</th>
                    <th>Numéro de Série</th>
                    <th>Numéro de PO</th>
                    <th>Date de PO</th>
                    <th>Actions</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
    {{-- Modal Nouvel Asset --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="add_asset">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('asset.store')}}" method="POST">
                    @csrf
                    <div class="modal-body row">
                        <div class="form-group row">
                            <label for="asset_type" class="form-group col-md-4 col-form-label">Type: </label>
                            <div class="col-md-8">
                                <select class="form-control form-control form-control-user" id="asset_type" name="asset_type">
                                    @foreach ($asset_type as $item)
                                        <option value="{{$item->id}}"> {{$item->type_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Informations </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-group form-control form-control-user" name="asset_code"  placeholder="Code d'Inventaire..."> 
                                        <input type="text" class="form-group form-control form-control-user" name="asset_invent"  placeholder="Numéro d'Inventaire..." required> 
                                        <input type="text" class="form-group form-control form-control-user" name="asset_desc"  placeholder="Description..." required> 
                                        <input type="text" class="form-group form-control form-control-user"  name="asset_serial"  placeholder="Numéro de Serie..." required> 
                                        <input type="text" class="form-group form-control form-control-user"  name="purch_order"  placeholder="Purchase Order..." required> 
                                        <div class="form-group row">
                                        <label for="asset_date" class="col-form-label col-md-5">Date d'achat:</label>
                                        <div class="col-md-7">
                                            <input type="date" class="form-group form-control form-control-user"  name="purch_order_date" required> 
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Commentaires </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="asset_comment" placeholder="Commentaires..." rows="3"></textarea>
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


    {{-- Modal Modifier Asset --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="edit_asset">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="e_modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('asset.update','asset_id') }}" method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="modal-body row">
                        <input type="hidden" class="form-group form-control form-control-user" name="m_asset_id" id="m_asset_id"> 
                        <input type="hidden" class="form-group form-control form-control-user" name="type_id" id="type_id"> 
                        <div class="form-group row">
                            <label for="asset_type" class="form-group col-md-4 col-form-label">Type: </label>
                            <div class="col-md-8">
                                <input type="text" class="form-group form-control form-control-user" id="type_description" name="type_description" disabled> 
                            </div>
                        </div> 
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Informations </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-group form-control form-control-user" id="asset_code" name="asset_code" > 
                                        <input type="text" class="form-group form-control form-control-user" id="asset_invent" name="asset_invent"  required> 
                                        <input type="text" class="form-group form-control form-control-user" id="asset_desc" name="asset_desc" required> 
                                        <input type="text" class="form-group form-control form-control-user" id="asset_serial" name="asset_serial" required> 
                                        <input type="text" class="form-group form-control form-control-user" id="purch_order" name="purch_order" required > 
                                        <div class="form-group row">
                                            <label for="asset_date" class="col-form-label col-md-5">Date d'achat:</label>
                                            <div class="col-md-7">
                                                <input type="date" class="form-group form-control form-control-user" id="purch_order_date" name="purch_order_date" required> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="form-group border border-primary rounded p-2 col-md-12">
                            <legend  class="w-auto col-form-label"> Commentaires </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea class="text-left form-control" id="asset_comment" name="asset_comment" rows="3"></textarea>
                                    </div>
                                </div>
                        </fieldset>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="savebtn">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Import Asset --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="import_asset">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title">Importation de Données</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('import_asset') }}" method="POST" enctype="multipart/form-data">
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
    {{-- Fin Modal Import Asset --}}

    {{-- Modal Supprimer Asset --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id='delete_asset'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title" id="d_modelHeading"></h5>              
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('asset.destroy','asset_id') }}"  method="POST">
                    @csrf
                    @method('DELETE') 
                    <div class="modal-body row">
                        <input type="hidden" class="form-group form-control form-control-user" id="d_asset_id" name="d_asset_id" > 
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
</div>

{{-- Fin Modal Supprimer Laptop --}}
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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
        ajax: "{{ route('asset.index') }}",

        columns: [
            {data: 'type_description', name: 'type_description',width: '150px', class: 'text-left'},
            {data: 'inventory_num', name: 'inventory_num',width: '150px', class: 'text-left'},
            {data: 'asset_description', name: 'asset_description',width: '150px', class: 'text-left'},
            {data: 'serial_num', name: 'serial_num',width: '150px', class: 'text-left'},
            {data: 'asset_po', name: 'asset_po',width: '150px', class: 'text-left'},
            {data: 'po_date', name: 'po_date',width: '150px', class: 'text-left'},
            {data: 'action', name: 'action', width: '100px', class: 'text-center',orderable: false, searchable: false},
        ]

    });
});

$('#createAsset').click(function () {
    $('#saveBtn').val("create-product");
    $('#m_asset_id').val('');
    $('#AddForm').trigger("reset");
    $('#modelHeading').html("Nouvel Asset");
    $('#add_asset').modal('show');
});

$('body').on('click', '.editAsset', function () {
    var m_asset_id = $(this).data('id');
    $.get("{{ route('asset.index') }}" +'/' + m_asset_id +'/edit', function (data) {
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
    $('#d_modelHeading').html("Supprimer Asset");
    $('#delete_asset').modal('show');
    $('#d_asset_id').val(d_asset_id);
    console.log(data[0]);
});
  
</script>
@endsection
