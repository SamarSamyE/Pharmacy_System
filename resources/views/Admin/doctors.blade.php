
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
