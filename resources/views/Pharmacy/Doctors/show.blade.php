
@extends('layouts.app')


@section('title') Index @endsection

@section('content')


<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">

      <img src="{{$doctor->type->avatar}}" class="img-fluid rounded-start" alt="...">

    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h5 class="card-title">Dr.{{$doctor->type->name}}</h5>
      <h5 class="card-title">Email: {{$doctor->type->email}}</h5>
      <h5 class="card-title">National_Id: {{$doctor->national_id}}</h5>
      <h5 class="card-text"> createdAt: {{$doctor->created_at->format('l jS \of F Y h:i:s A')}}  </h5>
      <h5 class="card-title">Is_banned: {{$doctor->is_banned}}</h5>

      
         

      </div>
    </div>
  </div>
</div>
@endsection