@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<div class="container w-75 card mt-5 shadow-lg">
@if($order->status !='WaitingForUserConfirmation')
     <form method="POST" action="{{route('orders.update',$order->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="mb-3">
@hasanyrole('admin|pharmacy')
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

<label>Medicine</label>
    <select class="select2" id="med" name="medicine_id[]" multiple="multiple" style="width: 100%;">
        <option></option>
        @foreach ($medicines as $medicine)
        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
    @endforeach
      </select>

      <div class="form-group">
        <label>Quantity</label>
        <select name="qun[]" id="medicine-select" class="select2" multiple="multiple"
            data-placeholder="Select a State" style="width: 100%;">
            <option></option>
            @for($qunt=1;$qunt<=10;$qunt++)
                    <option value="{{$qunt}}">{{$qunt}}</option>
                @endfor
        </select>
        <!-- /.form-group -->
    </div>
@endrole
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
    @else
        <p>You can't edit now, We wait the user confirmation</p>
    @endif

</div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>

$(document).ready(function() {
    $('.select2').select2();
});
    </script>
@endsection































