@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="container card mt-6 shadow-lg">
        <div class="card-header h3">
            Post Info
        </div>
        <div class="card-body fs-5">
            <div class=row>
            <div class="col-md-6">
            <p class="card-text">Name: {{$pharmacy->type->name}}</p>
            <p class="card-text">Email: {{$pharmacy->type->email}}</p>
            <p class="card-text">Priority: {{$pharmacy->priority}}</p>
            <p class="card-text">Area Name: {{$pharmacy->area_name}}</p>
            <p class="card-text">Created_at: {{$pharmacy->created_at}}</p>
            <div>
            <img src="{{asset('storage/'.$pharmacy->type->avatar)}}" class="img-fluid" style="height: 100px; width: 100px"/>
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection
