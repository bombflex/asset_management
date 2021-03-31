@extends('layouts.admin')

@section('contenu')
<div class="container mt-5 table-responsive">
    <h5 class="mb-4">Liste du personnel</h5>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>email</th>
                <th>Bureau</th>
                <th>Section</th>
                <th width="20px">Fonction</th>
                <th>Extension</th>
                <th>Ligne_direct</th>
                <th>Num_flotte</th>
                <th>Callsign</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


   {{--  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script> --}}

<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('employe.index') }}",
          columns: [
              {data: 'nom_emp', name: 'nom_emp'},
              {data: 'email', name: 'email'},
              {data: 'nom_bur', name: 'nom_bur'},
              {data: 'nom_unite', name: 'unite'},
              {data: 'fonction_emp', name: 'fonction_emp'},
              {data: 'extension_emp', name: 'extension_emp'},
              {data: 'ligne_direct', name: 'ligne_direct'},
              {data: 'num_flotte', name: 'num_flotte'},
              {data: 'callsign', name: 'callsign'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
  </script>
  @endsection