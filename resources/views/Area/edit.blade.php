@extends('layouts.app')

@section('title')
    edit Area
@endsection

@section('content')

<form method="POST" action="{{route('area.update',$area->id)}} "style="padding: 3%;
    border: 2px solid #abe3c0;
    margin-right: 10%;
    width: 50%;
   height:20%;
   margin-top:3%;
    margin-left: 23%;">
        @csrf
        @method('PUT')
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Name</strong></label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="{{$area->name}}">
        </div>
        <div class="mt-3 mb-3">
            <label for="exampleFormControlInput1" class="form-label"><strong>Address</strong></label>
            <input name="address" type="text" class="form-control" id="exampleFormControlInput1"  value="{{$area->address}}">
        </div>
        <div class="mb-3">
        <label for="user-name">COUNTRY</label>
            <select name="country_id" class="form-control mb-2" id="country">
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            </div>
        <button class="btn btn-success"  style="
border:none;
        font-weight: 800;
    color: white;
    width:30%;
    
    background-color:#53be8b;>;
    font-size: 20px;
    margin-left: 32%; margin-top:5%">Submit</button>
    </form>
@endsection