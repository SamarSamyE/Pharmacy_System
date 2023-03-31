@extends('layouts.app')


@section('title') Index @endsection

@section('content')

    <table class="table mt-4 container fs-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Area Id</th>
            <th scope="col">Priority</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
           @foreach($pharmacies as $pharmacy)
            <tr>

                <td>{{$pharmacy->type->avatar}}</td>
                <td>{{$pharmacy->type->name}}</td>
                <td>{{$pharmacy->area_id}}</td>
                <td>{{$pharmacy->priority}}</td>
                <td>{{$pharmacy->created_at}}</td>
                <td style="display: flex; flex-direction:row; gap: 20px" >
                    <a href="{{route('pharmacies.show', $pharmacy->id)}}" class="btn btn-info fs-4">View</a>
                    <a href="{{route('pharmacies.edit', $pharmacy->id)}}"  class="btn btn-primary fs-4">Edit</a>
                    <form method="post" action="{{route('pharmacies.destroy', $pharmacy->id)}}"
                    onclick="return confirm('Are you sure you want to delete this pharmacy?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger fs-4">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
 
    </table>

@endsection

