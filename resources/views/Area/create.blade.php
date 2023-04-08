@extends('layouts.app')

@section('title')
    Create Area
@endsection

@section('content')

<body style=" background: linear-gradient(90deg, rgb(166 163 220) 0%, rgb(252 243 249) 35%, rgb(237 244 246 / 82%) 100%);
">

<div style=" 
    padding: 2%;
    font-size: 20px;
    color:#2a486f;>;
    line-height: 2;
    margin-left: 30%;
    margin-top: 2%;
    max-width: 32%;
    box-shadow:0 10px 50px rgb(6 86 80 / 30%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    height: 450px;
    background-color: white;">
    <form  method="POST" action= "{{route('area.store')}}" enctype="multipart/form-data">
        @csrf
     
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input name="name" type="text" placeholder="Full name"class="form-control" id="exampleFormControlInput1" style=" 
                
    height: 45px;">
        
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
             
            <input name="address" type="text" placeholder="Enter the address" class="form-control" id="exampleFormControlInput1" style="
    height: 45px;">
        </div>

        <div class="mb-3">
        <label for="user-name">COUNTRY</label>
            <select name="country_id" class="form-control mb-2" placeholder="Enter the address" id="country"style="
    height: 45px;">
                @foreach($countries as $country)
               
                <option value="{{$country->id}}" style="width:40%;">{{$country->name}}</option>
                @endforeach
            </select>

        </div>
        <button class="btn btn-success" style="
    border:none;
        font-weight: 800;
    color: white;
    width:40%;
    
    background-color:#2a486f;>;
    font-size: 20px;
    margin-left: 32%;
    margin-top: 5%;">Submit</button>
    </form>
@endsection