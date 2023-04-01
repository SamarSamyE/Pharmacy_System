
@extends('layouts.app')


@section('title') Index @endsection

@section('content')


    <div class="text-center">
        <a href="{{route('Doctors.create')}}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">name</th>
            <th scope="col">national_id</th>
            <th scope="col">pharmacy_id</th>
            <th scope="col">is_banned</th>
            <th scope="col">email</th>
            <th scope="col">avatar</th>
            <th scope="col">created_at</th>
            <!-- <th scope="col">Created At</th>
            <th scope="col">Actions</th> -->
        </tr>
        </thead>
        <tbody>
<!-- i can access obj k arr or arrow -->
@foreach($Doctor as $doc)
            <tr>
            <td>{{$doc->type->name}}</td>
                <td>{{$doc->national_id}}</td>
                <td>{{$doc->pharmacy_id}}</td>
                <td>{{$doc->is_banned}}</td>
                <td>{{$doc->type->email}}</td>
                <td>{{$doc->type->avatar}}</td>
                <td>{{$doc->type->created_at->format('Y-m-d')}}</td>

                <!-- @if($doc->user)
                <td>{{$doc->user->name}}</td>
                @else
                <td>not found</td>
                @endif -->
                <td>
            

                    <a href="{{route('Doctors.show', $doc->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('Doctors.edit', $doc->id)}}"  class="btn btn-primary">Edit</a>
                    <!-- delete in a form method to can add my action -->
                    <form style="display:inline" method="post" action="{{route('Doctors.destroy', $doc->id)}}"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>

                    </tr>
@endforeach
        </tbody>

       
        <!-- Booosa   -->
        
    </table>
    @endsection

   