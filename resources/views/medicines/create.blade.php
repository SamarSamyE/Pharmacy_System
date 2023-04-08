@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<body style="    background: linear-gradient(90deg, rgb(166 163 220) 0%, rgb(252 243 249) 35%, rgb(237 244 246 / 82%) 100%);
">

<form action="{{ route('medicines.store')}}" method="post"enctype="multipart/form-data"
style=" 
    padding: 2%;
    font-size: 20px;
    color:#2a486f;>;
    line-height: 2;
    margin-left: 30%;
    margin-top: 2%;
    max-width: 32%;
    box-shadow:0 10px 50px rgb(6 86 80 / 30%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    height: 630px;
    background-color: white;">
    @csrf
   
    <div class="card-header" style="font-family: ui-rounded;
    font-weight: bolder;
    margin-bottom: 5%;
    /* margin-left: 20%; */
    text-align: center;
    font-size: 30px; 
    
    ">{{ __('Create Medicine ') }}</div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Medicine Type</label>
            <input name="type" class="form-control"placeholder="Medicine Type" id="exampleFormControlInput1"rows="3" >
        </div>

            
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Name</label>
            <input name="name" type="text" placeholder="National Name" class="form-control" id="exampleFormControlInput1"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine price</label>
            <input name="price" type="number" placeholder="Medicine price" class="form-control" id="exampleFormControlInput1"   >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Medicine Quantity</label>
            <input name="quantity" type="number" placeholder="Medicine quantity" class="form-control" id="exampleFormControlInput1"   >
        </div>


        
<button type="primary" class="Btn btn-success"
style="
border:none;
        font-weight: 800;
    color: white;
    width:40%;
    
    background-color:#2a486f;>;
    font-size: 20px;
    margin-left: 32%;
    margin-top: 5%;">create</button>

</form>
@endsection