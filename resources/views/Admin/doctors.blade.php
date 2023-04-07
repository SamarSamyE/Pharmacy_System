
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"> Doctors</div>
            <div class="card-body">
            <div class="text-center">
            @hasanyrole('pharmacy|admin')
        <a href="{{route('doctors.create')}}" class="mt-1 btn btn-primary fs-3">+New doctor</a>
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

$('body').on('click', '#delete-doctor', function () {

  var doctorURL = $(this).data('url');
  var trObj = $(this);

  if(confirm("Are you sure you want to remove this doctor?") == true){
        $.ajax({
            url: doctorURL,
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
