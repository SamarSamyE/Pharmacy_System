@extends('layouts.app')

@section('title') Show @endsection

@section('content')


<form action="{{ route('medicines.store')}}" method="post"enctype="multipart/form-data">
    @csrf
   
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Medicine Type</label>
            <input name="type" class="form-control" id="exampleFormControlInput1"rows="3" >
        </div>

            
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine price</label>
            <input name="price" type="number" class="form-control" id="exampleFormControlInput1"   >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Quantity</label>
            <input name="quantity" type="number" class="form-control" id="exampleFormControlInput1"   >
        </div>


        
<button type="primary" class="Btn btn-success">create</button>

</form>
@endsection