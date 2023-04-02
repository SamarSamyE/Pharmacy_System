@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="container card mt-6 shadow-lg">
        <div class="card-header h3">
            Area Info
        </div>
        <div class="card-body fs-5">
            <div class=row>
            <div class="col-md-6">
            <p class="card-text">Name: {{$area->name}}</p>
            <p class="card-text">Email: {{$area->address}}</p>
            <p class="card-text">Created_at: {{$area->created_at}}</p>
            </div>
            </div>
        </div>
    </div>
@endsection
