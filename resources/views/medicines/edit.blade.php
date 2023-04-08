@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<body>
<form method="post" action="{{ route('medicines.update', $medicine->id) }}" style="padding: 3%;
    border: 2px solid #abe3c0;;
    margin-right: 10%;
    width: 50%;
   
    margin-left: 23%;"enctype="multipart/form-data">
 
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
      

<button type="primary" class="btn btn-success" style="
border:none;
        font-weight: 800;
    color: white;
    width:30%;
    
    background-color:#53be8b;>;
    font-size: 20px;
    margin-left: 32%;
    ">update</button>
</form>
@endsection