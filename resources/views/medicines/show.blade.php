@extends('layouts.app')


@section('title') Index @endsection

@section('content')


<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">

    {{-- <td><img src="{{asset ('storage/'.$doctor->type->avatar)}}" class="img-fluid rounded-3 " style="height: 150px; width: 150px ;margin-top:20px" ></td> --}}

    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h5 class="card-title">Medicine Id:{{$medicine->id}}</h5>
      <h5 class="card-title">Medicine Type: {{$medicine->type}}</h5>
      <h5 class="card-title">Medicine Name: {{$medicine->name}}</h5>
      <h5 class="card-title">Medicine Quantity: {{$medicine->quantity}}</h5>
      <h5 class="card-title">Medicine Price: {{$medicine->price}}</h5>
      <h5 class="card-text"> createdAt: {{$medicine->created_at->format('l jS \of F Y h:i:s A')}}  </h5>
    

      
         

      </div>
    </div>
  </div>
</div>
@endsection