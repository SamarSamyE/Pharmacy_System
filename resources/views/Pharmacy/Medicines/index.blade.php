
@extends('layouts.app')


@section('title') Index @endsection

@section('content')


    <div class="text-center">
        <a href="#" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
<!-- i can access obj k arr or arrow -->
     
                <td>
                    <a href="#" class="btn btn-info">View</a>
                    <a href="#"  class="btn btn-primary">Edit</a>
                    <!-- delete in a form method to can add my action -->
                    <form style="display:inline" method="post" action="#"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
        </tbody>
       
       
        <!-- Booosa   -->
        
    </table>
    @endsection

   