@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<form method="post" action="{{route('doctors.update', $doctor->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

<div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$doctor->type->name}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input name="email" class="form-control" id="exampleFormControlInput1" rows="3"  value="{{$doctor->type->email}}" >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">National_Id</label>
            <input name="national_id" type="number" class="form-control" id="exampleFormControlInput1" value="{{$doctor->national_id}}" >
        </div>
       
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleFormControlInput1"  value="{{$doctor->type->password}}"  >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">pharmacy_id</label>
            <input name="pharmacy_id" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$doctor->pharmacy_id}}"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3"  value="{{$doctor->type->avatar}}">
        </div>
  

        <br><br><br>
      

<button type="primary" class="btn btn-success">update</button>
</form>
@endsection