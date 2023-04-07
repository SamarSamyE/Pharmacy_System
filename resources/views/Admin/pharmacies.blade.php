
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
            <div class="text-center">
                @role('admin')
        <a href="{{route('pharmacies.create')}}" class="mt-4 btn btn-success fs-4">Create Pharmacy</a>
        <a href="{{route('pharmacies.showTrashed')}}" class="mt-4 btn btn-success fs-4">Show Trashed</a>
                @endrole
         </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function () {

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('click', '#delete-pharmacy', function () {

  var pharmacyURL = $(this).data('url');
  var trObj = $(this);

  if(confirm("Are you sure you want to remove this pharmacy?") == true){
        $.ajax({
            url: pharmacyURL,
            type: 'DELETE',
            dataType: 'json',
            success: function(data) {
                alert(data.success);
                trObj.parents("tr").remove();
            },
            error: function (data) {
                    alert(data.responseJSON.error);
                }
        });
  }


});

});
</script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
