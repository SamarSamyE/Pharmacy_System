
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
            <div class="text-center">
        <a href="{{route('pharmacies.create')}}" class="mt-4 btn btn-success fs-4">Create Pharmacy</a>
        <a href="{{route('pharmacies.showTrashed')}}" class="mt-4 btn btn-success fs-4">Show Trashed</a>
         </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
