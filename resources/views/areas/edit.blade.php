@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<div class="container w-75 card mt-5 shadow-lg">
    <form method="POST" action="{{route('areas.update',$area->id)}}" >
        @csrf
        @method('PUT')
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Name</strong></label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="{{$area->name}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Address</strong></label>
            <input name="address" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$area->address}}">
        </div>
        <button class="btn btn-success fs-4 mb-3">Update</button>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
