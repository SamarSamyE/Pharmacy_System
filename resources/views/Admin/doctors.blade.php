@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{route('pharmacies.create')}}" class="mt-4 btn btn-success fs-4">Create Post</a>
    </div>
    <table class="table mt-4 container fs-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Pharmacy</th>
            <th scope="col">created_at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($doctors as $doctor)
            <tr>
                <td>{{$doctor->id}}</td>
                <td><img src="{{'dist/img/'.$doctor->type->avatar}}" class="img-fluid rounded-3 " style="height: 50px; width: 50px"></td>
                <td>{{$doctor->type->name}}</td>
                <td>{{$doctor->pharmacy->type->name}}</td>
                <td>{{$doctor->created_at}}</td>
                <td style="display: flex; flex-direction:row; gap: 20px" >
                    <a href="{{route('pharmacies.show', $doctor->id)}}" class="btn btn-info fs-4">View</a>
                    <a href="{{route('pharmacies.edit', $doctor->id)}}"  class="btn btn-primary fs-4">Edit</a>
                    <form method="post" action="{{route('pharmacies.destroy', $doctor->id)}}"
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
