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


        <button class="btn btn-success fs-4 mb-3">Submit</button>
    </form>

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
