@extends('layouts.app')


@section('title') Index @endsection

@section('content')


<div class="card mb-3" style=" 
    padding: 2%;
    font-size: 20px;
    color:#2a486f;>;
    line-height: 1.7;
    margin-left: 35%;
    margin-top: 2%;
    max-width: 32%;
    box-shadow:0 10px 50px rgb(6 86 80 / 30%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    height: 650px;
    background-color: white;">

<div  style="font-family: ui-rounded;
    font-weight: bolder;
    margin-bottom: 5%;
    text-align: center;
    font-size: 24px;
    padding-right:10%; 
    
    ">{{ __('About this medicine ') }}</div>
    <hr style="width:70% ;margin-left:10%; ">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
      <h5 class="card-title" style="font-size:22px">Medicine Id:  {{$medicine->id}}</h5> <br>
      <h5 class="card-title"style="font-size:22px">Medicine type:  {{$medicine->type}}</h5>
      <br>
      <h5 class="card-title"style="font-size:22px">Medicine name:  {{$medicine->name}}</h5>
      <br>

      <h5 class="card-title"style="font-size:22px">Medicine quantity:  {{$medicine->quantity}}</h5>
      <br>
      <h5 class="card-title"style="font-size:22px">Medicine price:  {{$medicine->price}}</h5>
      <br>
      <h5 class="card-text"style="font-size:22px"> createdAt:   {{$medicine->created_at->format('l jS \of F Y h:i:s A')}}  </h5>

    

      
         

      </div>
    </div>
  </div>
</div>
@endsection