@extends('layouts.app')

@section('title') Show @endsection

@section('content')

<body style="    background: linear-gradient(90deg, rgb(166 163 220) 0%, rgb(252 243 249) 35%, rgb(237 244 246 / 82%) 100%);
">
<form action="{{ route('doctors.store')}}" method="post"enctype="multipart/form-data"
style=" 
    padding: 2%;
    font-size: 18px;
    color:#2a486f;;
    line-height: 2;
    margin-left: 30%;
    margin-top: 2%;
    max-width: 35%;
    box-shadow:0 10px 50px rgb(6 86 80 / 30%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    height: 820px;
    background-color: white;">
    @csrf

    <div class="card-header" style="font-family: ui-rounded;
    font-weight: bolder;
    margin-bottom: 5%;
    /* margin-left: 20%; */
    text-align: center;
    font-size: 30px; 
    
    ">{{ __('Create Doctor ') }}</div>

<div class="mb-3">
<label for="exampleFormControlTextarea1" class="form-label">Full name</label>
<input name="name" type="text" placeholder="Full name"class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
      
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input name="email" class="form-control" placeholder="Email Address" id="exampleFormControlInput1"rows="3"   >
        </div>


        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input name="password" type="password"  placeholder="Password"class="form-control" id="exampleFormControlInput1"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">National_Id</label>
            <input name="national_id" type="text" placeholder="National ID"class="form-control" id="exampleFormControlInput1"   >
        </div>
        @role('admin')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">pharmacy_id</label>
            <input name="pharmacy_id" type="text" placeholder="Pharmacy ID" class="form-control" id="exampleFormControlInput1"   >
        </div>
        @endrole
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>



<button type="primary" class="Btn btn-success"  style="
        font-weight: 800;
    color: white;
    width:40%;
    background-color: #2a486f;>;
    font-size: 20px;
    margin-left: 32%;
    margin-top: 7%;
    border:none;
    ">create</button>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</form>
@endsection
