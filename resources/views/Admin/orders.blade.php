@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Orders</div>
            <div class="card-body">
            @hasanyrole('admin|patient')
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
