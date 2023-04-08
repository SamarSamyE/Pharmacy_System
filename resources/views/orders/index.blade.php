@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end">
    <a  class="btn btn-success rounded me-2"href="{{route('Orders.create')}}">Create New Order</a>
   
</div>

<div class="container-fluid">
    {{ $dataTable->table() }}
</div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush