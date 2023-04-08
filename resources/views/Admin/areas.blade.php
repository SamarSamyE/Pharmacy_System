@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
            <div class="text-center">
        <a href="{{route('area.create')}}" class="mt-4 btn btn-success fs-4">Create Area</a>
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

$('body').on('click', '#delete-area', function () {

  var areaURL = $(this).data('url');
  var trObj = $(this);

  if(confirm("Are you sure you want to remove this area?") == true){
        $.ajax({
            url: areaURL,
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
