@extends('layouts.app')

@section('title') Show @endsection

@section('content')


<form action="{{ route('orders.store')}}" method="post"enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Prescriptions</label>
            <input type="file" name="avatar[]" class="form-control" id="exampleFormControlTextarea1" rows="3" multiple="multiple">
    </div>

    <div class="mb-3">
        <label class="form-label">Is your order insured?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="yes_radio" value="1">
            <label class="form-check-label" for="yes_radio">
                Yes
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="no_radio" value="0" checked>
            <label class="form-check-label" for="no_radio">
                No
            </label>
        </div>

        <div class="mb-3">
        <label for="description" class="form-label">Delivery Address</label>
        <select style="width:30%" name="patient_address_id" class="form-control" >
          @foreach($addresses as $address)
              <option value="{{$address->id}}">{{$address->street_name}}</option>
          @endforeach
      </select>
      </div>
    </div>



<button type="primary" class="Btn btn-success">create</button>

</form>
@endsection
