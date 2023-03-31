@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{route('pharmacies.create')}}" class="mt-4 btn btn-success fs-4">Create Pharmacy</a>
    </div>
    <table class="table mt-4 container fs-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">priority</th>
            <th scope="col">Area Name</th>
            <th scope="col">created_at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($pharmacies as $pharmacy)
            <tr>
                <td>{{$pharmacy->id}}</td>
                <td><img src="{{'dist/img/'.$pharmacy->type->avatar}}" class="img-fluid rounded-3 " style="height: 50px; width: 50px"></td>
                <td>{{$pharmacy->type->name}}</td>
                <td>{{$pharmacy->priority}}</td>
                <td>{{$pharmacy->area_name}}</td>
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
