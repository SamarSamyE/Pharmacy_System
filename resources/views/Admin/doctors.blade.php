
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"> Doctors</div>
            <div class="card-body">
            <div class="text-center">
            @hasanyrole('pharmcy|admin')
        <a href="{{route('doctors.create')}}" class="mt-4 btn btn-success fs-4">Create Doctor</a>
            @endrole
         </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
