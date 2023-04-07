@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<div class="container w-75 card mt-5 shadow-lg">

     <form method="POST" action="{{route('orders.store')}}" enctype="multipart/form-data">
        @csrf
         <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>User Name</strong></label>
            <select name="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->type->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
    <label for="is_insured">Is Insured?</label>
    <select class="form-control" id="is_insured" name="is_insured">
        <option value="1" >Yes</option>
        <option value="0">No</option>
    </select>
    </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Medicine Name</strong></label>
            <select name="medicine_id" class="form-control">
                @foreach($medicines as $medicine)
                    <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                @endforeach
            </select>
        </div>

        @role('admin')
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>pharmacy Name</strong></label>
            <select name="pharmacy_id" class="form-control">
                @foreach($pharmacies as $pharmacy)
                    <option value="{{$pharmacy->id}}">{{$pharmacy->type->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Doctor Name</strong></label>
            <select name="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->type->name}}</option>
                @endforeach
            </select>
        </div>
        @endrole

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Quantity</strong></label>
            <input type="text" name="quantity" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>

        <button class="btn btn-success fs-4 mb-3">Submit</button>
    </form>

</div>
@endsection
