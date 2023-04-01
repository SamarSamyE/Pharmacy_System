@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<div class="container w-75 card mt-5 shadow-lg">

     <form method="POST" action="{{route('pharmacies.update',$pharmacy->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Name</strong></label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="{{$pharmacy->type->name}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Email</strong></label>
            <input name="email" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$pharmacy->type->email}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Password</strong></label>
            <input name="password" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$pharmacy->type->password}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>National ID</strong></label>
            <input name="national_id" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$pharmacy->national_id}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Priority</strong></strong></label>
            <input name="priority" type="text" class="form-control" id="exampleFormControlInput1" value=" {{$pharmacy->priority}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Area ID</strong></label>
            <input name="area_id" type="text" class="form-control" id="exampleFormControlInput1" value="{{$pharmacy->area_id}}" >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Image</strong></label>
            <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>

        <button class="btn btn-success fs-4 mb-3">Submit</button>
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
