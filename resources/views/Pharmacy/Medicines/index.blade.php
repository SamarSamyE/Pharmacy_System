
@extends('layouts.app')


@section('title') Index @endsection

@section('content')


    <div class="text-center">
        <a href="{{route('Medicines.create')}}" class="mt-4 btn btn-success">Add New Medicines</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">id</th>
            <th scope="col">type</th>
            <th scope="col">name</th>
            <th scope="col">price</th>
            <th scope="col">quantity</th>
            {{-- <th scope="col">avatar</th> --}}
            <th scope="col">created_at</th>
            <!-- <th scope="col">Created At</th>
            <th scope="col">Actions</th> -->
        </tr>
        </thead>
        <tbody>
<!-- i can access obj k arr or arrow -->
@foreach($Medicine as $medicine)
            <tr>
            <td>{{$medicine->id}}</td>
                <td>{{$medicine->type}}</td>
                <td>{{$medicine->name}}</td>
                <td>{{$medicine->price}}</td>
                <td>{{$medicine->quantity}}</td>
                {{-- <td><img src="{{asset ('storage/'.$doc->type->avatar)}}" class="img-fluid rounded-3 " style="height: 50px; width: 50px"></td> --}}
                <td>{{$medicine->created_at->format('Y-m-d')}}</td>

                {{-- <!-- @if($doc->user)
                <td>{{$doc->user->name}}</td>
                @else
                <td>not found</td>
                @endif --> --}}
                <td>
            

                    <a href="{{ route('Medicines.show',$medicine->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('Medicines.edit',$medicine->id) }}"  class="btn btn-primary">Edit</a>
                    <!-- delete in a form method to can add my action -->
                    <form style="display:inline" method="post" action="{{route('Medicines.destroy', $medicine->id)}}"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>

                    </tr>
@endforeach
        </tbody>

       
        
    </table>
    @endsection

   