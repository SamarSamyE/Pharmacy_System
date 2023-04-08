
@extends('layouts.app')


@section('title') Index @endsection

@section('content')


</div>



<body >
<div class="card mb-3" style="    letter-spacing: 1px;
    height: 550px;
    font-family: auto;
    margin-left: 30%;
    text-align: center;
    background-color: #edfaff;
    border: none;
    max-width: 500px;
    /* padding-left: 120px; */
    color: #0f4667;
    box-shadow:0 10px 50px rgb(6 86 80 / 30%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  padding-top: 30px;
">
<div class="col-md-4">
    <td><img src="{{asset ('storage/'.$doctor->type->avatar)}}" class="img " style="border-radius: 100%;
    height: 85%;
    width: 90%;
    margin-top: 5%;
    margin-left: 100%;
    
    " ></td> 

    </div>
  <div class="row g-0">
    
    <div class="col-md-8">
      <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;
    font-size: 25px; margin-left:50%;text-align:center;
    ">Dr.{{$doctor->type->name}}</h5>
       
    
      </div></div>
      <div class="col-md-12">
        <hr style="width:55%;margin-left:22%">
       <h5 class="card-title" style="font-size:23px">Email: {{$doctor->type->email}}</h5>
      
      <h5 class="card-title"style="font-size:23px">National_Id: {{$doctor->national_id}}</h5>
      <h5 class="card-text"style="font-size:22px"> createdAt: {{$doctor->created_at->format('l jS \of F Y h:i:s A')}}  </h5>
      <h5 class="card-title"style="font-size:22px">Is_banned: {{$doctor->is_banned}}</h5>
      </div></div>
  
    

    
      </div>
    </div>
    </div>
  </div>
</div>
</body>
@endsection