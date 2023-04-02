@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <table class="table mt-4 container fs-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">priority</th>
            <th scope="col">Area Name</th>
            <th scope="col">created_at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

           @foreach($deletedPharmacies as $pharmacy)
            <tr>
                <td>{{$pharmacy->id}}</td>
                <td>{{$pharmacy->type->name}}</td>
                <td>{{$pharmacy->priority}}</td>
                <td>{{$pharmacy->area_name}}</td>
                <td>{{$pharmacy->created_at}}</td>
                <td style="display: flex; flex-direction:row; gap: 20px" >
                <form method="post" action="{{route('pharmacies.restoreTrashedPharmacies', $pharmacy->id)}}"
                    onclick="return confirm('Are you want to restore this pharmacy again?')">
                        @method('PATCH')
                        @csrf
                        <button class="btn btn-danger fs-4">Restore</button>
                    </form>
                    <form method="post" action="{{route('pharmacies.forceDelete', $pharmacy->id)}}"
                    onclick="return confirm('Are you sure you want to delete this pharmacy permanently?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger fs-4">Permanently Deleted</button>
                    </form>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection
