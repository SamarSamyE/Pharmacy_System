@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Orders</div>
            <div class="card-body">
            @hasanyrole('admin|pharmacy')
            <a href="{{route('orders.create')}}" class="mt-4 btn btn-success fs-4">Create New Order</a>
            @endrole
            <div class="text-center">
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

$('body').on('click', '#delete-order', function () {

  var orderURL = $(this).data('url');
  var trObj = $(this);

  if(confirm("Are you sure you want to remove this order?") == true){
        $.ajax({
            url: orderURL,
            type: 'DELETE',
            dataType: 'json',
            success: function(data) {
                alert(data.success);
                // trObj.parents("tr").remove();
                trObj.closest("tr").remove();

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
