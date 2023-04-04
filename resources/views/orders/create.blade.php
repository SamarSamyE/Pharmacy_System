@extends("layouts.app")

@section('title' , 'Create')

@section('style')

@endsection
    

@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection


@section('content')

<div class="card card-primary">
        <form method="POST" id="create-pharmacy-form" enctype="multipart/form-data" action="{{ route('Orders.store') }}">
          @csrf
            <div class="card-body">
                    
                <div class="form-group" data-select2-id="13">
                  <label for="Patientname">Choose the User</label>
                  <select name="Patientname" class="form-control select2 select2-hidden-accessible" style="width: 30%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{$patient->type->name}}</option>
                    @endforeach
                  </select>
                  <!-- </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-o8pk-container"><span class="select2-selection__rendered" id="select2-o8pk-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                </div>

                <div class="col-md-6 mb-3 ml-3 ">
                  <input name="is_insured" class="form-check-input" type="checkbox" id="banned" value="">
                  <label for="createPharmacyName" class="form-check-label">Is insured?</label>
              </div>
            <br>

    <div class="mb-3">
        <label for="description" class="form-label">Medicines</label>
        <select style="width:30%" name="medicines" class="form-control">
          @foreach($medicine as $medicine)
              <option value="{{$medicine->id}}">{{$medicine->name}}</option>
          @endforeach
      </select>
      </div>

                  <div class="form-group">
                  <label for="exampleFormControlInput1" class="form-label">Quantity</label>
            <input style="width:30%" name="quantity" type="text" class="form-control" id="exampleFormControlInput1" >


                  </div>

                  <div class="form-group">
                        <label for="DocName">Doctor Name</label>
                        <select name="DocName" class="form-control select2 select2-hidden-accessible" style="width: 30%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                          @foreach($doctors as $doctor)
                          <option value="{{ $doctor->id }}">{{$doctor->type->name}}</option>
                          @endforeach
                        </select>
                  </div>

                  <div class="form-group">
                        <label for="PharmacyName">Pharmacy Name</label>
                        <select name="PharmacyName" class="form-control select2 select2-hidden-accessible" style="width: 30%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                          @foreach($pharmacy as $pharma)
                          <option value="{{ $pharma->id }}">{{$pharma->type->name}}</option>
                          @endforeach
                        </select>
                  </div>

                  <div class="col-md-6 mb-2">
                    <label for="createOrderCreator" class="form-label">Order Creator</label>
                    <select name="creator_type" id="createPharmacyName" class="form-control" style="width:30%;">
                        <option value="" disabled selected hidden></option>
                        <option value="patient">patient</option>
                        <option value="doctor">doctor</option>
                        <option value="pharmacy">pharmacy</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

           
                <button style="margin-left:30px ;width:150px"  type="submit" class="btn btn-success ">Create</button>
        </form>
    </div>


@endsection









