@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div style=" letter-spacing: 1.2px;
    height: 670px;
    font-family: auto;
    margin-left: 30%;
  margin-top:2%;
    border: none;
    max-width: 500px;
    /* padding-left: 120px; */
    color: #0f4667;
    background-color: white;
    padding-top: 30px;
    padding-left: 3%;
    padding-bottom:5%;
    box-shadow:0 10px 50px rgb(6 86 80 / 30%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
">
        <div style="margin-left:25%; font-size:22px">
            Pharmacy Data
        </div>
        <hr style="margin-left:10%;width:70%;margin-top:10%;margin-bottom:10%">
        <div class="card-body fs-5">
            <div class=row>
            <div class="col-md-6">
            <p class="card-text" style="font-size:22px">Name: {{$pharmacy->type->name}}</p>
            <p class="card-text"style="font-size:20px">Email: {{$pharmacy->type->email}}</p>
            <p class="card-text"style="font-size:20px">Priority: {{$pharmacy->priority}}</p>
            <p class="card-text" style="font-size:20px">Area Name: {{$pharmacy->area_name}}</p>
            <p class="card-text"style="font-size:20px">Created_at: {{$pharmacy->created_at}}</p>
            <div>
            <img src="{{asset('storage/'.$pharmacy->type->avatar)}}" class="img-fluid" style="height: 130px; width: 120px"/>
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection
