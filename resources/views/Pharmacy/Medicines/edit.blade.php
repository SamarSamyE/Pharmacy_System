@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<form method="post" action="{{ route('Medicines.update', $medicine->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

<div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Id</label>
            <input name="id" type="number" class="form-control" id="exampleFormControlInput1"  value="{{$medicine->id}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Medicine Type</label>
            <input name="type" class="form-control" id="exampleFormControlInput1" rows="3"  value="{{$medicine->type}}" >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Name</label>
            <input name="name" type="name" class="form-control" id="exampleFormControlInput1" value="{{$medicine->name}}" >
        </div>
       
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Price</label>
            <input name="price" type="number" class="form-control" id="exampleFormControlInput1"  value="{{$medicine->price}}"  >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">quantity</label>
            <input name="quantity" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$medicine->quantity}}"   >
        </div>

        {{-- <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3"  value="{{$doctor->type->avatar}}">
        </div>
   --}}

        <br><br><br>
      

<button type="primary" class="btn btn-success">update</button>
</form>
@endsection