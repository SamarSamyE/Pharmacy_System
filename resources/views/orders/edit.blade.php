@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<div class="container w-75 card mt-5 shadow-lg">

     <form method="POST" action="{{route('orders.update',$order->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="mb-3">

            <label for="exampleFormControlTextarea1" class="form-label"><strong>User Name</strong></label>
            <select name="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->type->name}}</option>
                @endforeach
                <option value="{{$patient->id}}" selected>{{$PastPatient}}</option>
            </select>
        </div>



    <div class="form-group">
    <label for="is_insured">Is Insured?</label>
      <select class="form-control" id="is_insured" name="is_insured">
        <option value="1" @if(old('is_insured', $order->is_insured)) selected @endif>Yes</option>
        <option value="0" @if(old('is_insured', !$order->is_insured)) selected @endif>No</option>
    </select>
</div>


        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Medicine Name</strong></label>
            <select name="medicine_id" class="form-control">
                @foreach($medicines as $medicine)
                    <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                @endforeach
                   <option value="{{$medicine->id}}" selected>{{$pastMedicine->name}}</option>
            </select>
        </div>

        @role('admin')
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>pharmacy Name</strong></label>
            <select name="pharmacy_id" class="form-control">
                @foreach($pharmacies as $pharmacy)
                    <option value="{{$pharmacy->id}}">{{$pharmacy->type->name}}</option>
                @endforeach
                <option value="{{$pharmacy->id}}" selected>{{$PastPharmacy->type->name}}</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Doctor Name</strong></label>
            <select name="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->type->name}}</option>
                @endforeach
                <option value="{{$doctor->id}}" selected>{{$PastDoctor->type->name}}</option>
            </select>
        </div>
        @endrole

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><strong>Quantity</strong></label>
            <input type="text" name="quantity" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{$order->medicineOrder->quantity}}">
        </div>


        <div class="form-group" data-select2-id="13">
                <label for="status">status</label>
                <select name="status" class="form-control" style="width: 100%;"  aria-hidden="true">
                    <option>Processing</option>
                    <option>Confirmed</option>
                    <option>Delivered</option>
                    <option>Canceled</option>
                    <option>WaitingForUserConfirmation</option>
                </select>
              </div>




        <button class="btn btn-success fs-4 mb-3">Submit</button>
    </form>

</div>
@endsection































