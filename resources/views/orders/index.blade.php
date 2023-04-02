@extends('layouts.app')


@section('title') Index @endsection

@section('content')


    <div class="text-center">
        <a href="#" class="mt-4 btn btn-success">Create Order</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">Order_Id</th>
            <th scope="col">Ordered_UserName</th>
            <th scope="col">Delevring_Address</th>
            <th scope="col">Doctor_Name</th>
            <th scope="col">Is_Insured</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
            <th scope="col">created_at</th>
        </tr>
        </thead>
        <tbody>
<!-- i can access obj k arr or arrow -->
@foreach($orders as $order)
            <tr>
            <td>{{$order->id}}</td>
                {{-- <td>{{$order->type->name}}</td> --}}
                {{-- <td>{{$doc->pharmacy_id}}</td>
                <td>{{$doc->is_banned}}</td>
                <td>{{$doc->type->email}}</td>
                <td><img src="{{asset ('storage/'.$doc->type->avatar)}}" class="img-fluid rounded-3 " style="height: 50px; width: 50px"></td>
                <td>{{$doc->type->created_at->format('Y-m-d')}}</td> --}}

                {{-- <!-- @if($doc->user)
                <td>{{$doc->user->name}}</td>
                @else
                <td>not found</td>
                @endif -->
                <td> --}}
            

                    {{-- <a href="#" class="btn btn-info">View</a>
                    <a href="#"  class="btn btn-primary">Edit</a>
                    <!-- delete in a form method to can add my action -->
                    <form style="display:inline" method="post" action="#"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>

                    </tr> --}}
@endforeach
        </tbody>

       
        
    </table>
    @endsection

   