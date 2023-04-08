@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<body style=" background: linear-gradient(90deg, rgb(166 163 220) 0%, rgb(252 243 249) 35%, rgb(237 244 246 / 82%) 100%);
">
<div class="container w-75 card mt-5 shadow-lg"
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
    height: 950px;
    background-color: white;">


<div class="card-header" style="font-family: ui-rounded;
    font-weight: bolder;
    margin-bottom: 5%;
    /* margin-left: 20%; */
    text-align: center;
    font-size: 30px; 
    
    ">{{ __('Create Pharmacy ') }}</div>
     <form method="POST" action="{{route('pharmacies.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Name</strong></label>
            <input name="name" type="text"placeholder="Full name" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Email</strong></label>
            <input name="email" type="text" placeholder="Email Address"class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Password</strong></label>
            <input name="password" type="text" placeholder="Password"class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>National ID</strong></label>
            <input name="national_id" type="text" placeholder="National ID"class="form-control" id="exampleFormControlInput1">
        </div>

        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Priority</strong></strong></label>
            <input name="priority" type="text"  placeholder=" Priority"class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Area ID</strong></label>
            <input name="area_id" type="text"  placeholder="Area ID" class="form-control" id="exampleFormControlInput1">
        </div>
        

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Image</strong></label>
            <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>

        <button class="btn btn-success fs-4 mb-3" style="
    border:none;
        font-weight: 800;
    color: white;
    width:40%;
    
    background-color:#2a486f;>;
    font-size: 20px;
    margin-left: 32%;
    margin-top: 5%;">Submit</button>
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
