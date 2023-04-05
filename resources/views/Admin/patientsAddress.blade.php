@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Patients Addresses</div>
            <div class="card-body">
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
