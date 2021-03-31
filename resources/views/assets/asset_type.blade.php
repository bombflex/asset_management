@extends('layouts.admin')

@section('contenu')
 
    <button data-toggle="modal" data-target="#add_asset_type" class="btn btn-primary">Nouveau</button>
    <br><br>
    <div class="table-responsive ">
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Commentaires</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asset_type as $item)
                        <tr>
                            <td >{{$item->description}}</td>
                            <td >{{$item->comment}}</td>
                            <td >
                                {{-- Bouton Modier --}}
                                <button type="button" data-toggle="modal" data-target="#edit_asset_type" class="btn editbtn btn-primary btn-sm fa fa-edit" 
                                data-type_id="{{$item->id}}" data-type_description="{{$item->description}}" data-type_comment="{{$item->comment}}" >
                                </button>
                                {{-- Fin Bouton Modier --}}

                                {{-- Bouton Supprimer --}}
                                <button type="button" data-toggle="modal" data-target="#delete_asset_type" class="btn btn-danger btn-sm fa fa-trash-alt"
                                data-type_id="{{$item->id}}"></button>
                                {{-- Fin Bouton Supprimer --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
{{-- Modal Nouveau Type Materiel --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="add_asset_type">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title">Type Materiel</h5>              
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                    </button>
                </div>
                <form class="col" action="{{route('assettype.store')}}" method="POST">
                    @csrf
                    <div class="modal-body row">
                        <input type="text" class="form-group form-control form-control-user" name="type_desc"  placeholder="Description..."> 
                        <textarea class="form-control" name="type_comment" placeholder="Commentaires..." rows="3"></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

{{-- Fin Modal Nouveau Type Materiel  --}}

{{-- Modal Modifier Type Materiel  --}}
    <div class="modal fade " data-backdrop="static" data-keyboard="false" id="edit_asset_type">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>              
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                    </button>
                </div>
                <form class="col" action="{{ route('assettype.update','type_id') }}"  method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="modal-body row">
                        <input type="hidden" class="form-group form-control form-control-user" id="type_id" name="type_id" > 
                        <input type="text" class="form-group form-control form-control-user" id="type_desc" name="type_desc" > 
                        <textarea class="form-control" id="type_comment" name="type_comment" rows="3"></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

{{-- Fin Modal Modifier Type Materiel  --}}

{{-- Modal Supprimer Type Materiel  --}}
<div class="modal fade " data-backdrop="static" data-keyboard="false" id="delete_asset_type">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title"></h5>              
                <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
                </button>
            </div>
            <form class="col" action="{{ route('assettype.destroy','type_id') }}"  method="POST">
                @csrf
                @method('DELETE') 
                <div class="modal-body row">
                    <input type="hidden" class="form-group form-control form-control-user" id="type_id" name="type_id" > 
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

{{-- Fin Modal Supprimer Type Materiel  --}}

 <!-- Bootstrap core JavaScript-->
{{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 --}}
<script>
    $('#edit_asset_type').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var type_id = button.data('type_id') // Extract info from data-* attributes
        var type_desc = button.data('type_description') // Extract info from data-* attributes
        var type_comment = button.data('type_comment') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        console.log(event.relatedTarget)
        var modal = $(this)
        modal.find('.modal-title').text('Modifier Type')
        modal.find('.modal-body #type_desc').val(type_desc)
        modal.find('.modal-body #type_comment').val(type_comment)
        modal.find('.modal-body #type_id').val(type_id)
    })
</script>

<script>
    $('#delete_asset_type').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var type_id = button.data('type_id') // Extract info from data-* attributes
        console.log(event.relatedTarget)

        var modal = $(this)
        modal.find('.modal-title').text('Supprimer Type')
        modal.find('.modal-body #type_id').val(type_id)
    })
</script>



@endsection