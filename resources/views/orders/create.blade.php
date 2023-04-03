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
        <form action="{{route ('Orders.store')}}" method="post">
          @csrf
            <div class="card-body">
                    
                <div class="form-group" data-select2-id="13">
                  <label for="name">Choose the User</label>
                  <select name="name" class="form-control select2 select2-hidden-accessible" style="width: 30%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @foreach($patients as $patient)
                    <option>{{$patient->type->name}}</option>
                    @endforeach
                  </select>
                  <!-- </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-o8pk-container"><span class="select2-selection__rendered" id="select2-o8pk-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                </div>

                <div class="form-check">
      <input class="form-check-input" name="is_insured" type="checkbox" value="1" id="is_insured">
      <label class="form-check-label" for="is_insured">
        Is insured?
      </label>
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
                          <option>{{$doctor->name}}</option>
                          @endforeach
                        </select>
                  </div>

                  <div class="form-group">
                        <label for="PharmacyName">Pharmacy Name</label>
                        <select name="PharmacyName" class="form-control select2 select2-hidden-accessible" style="width: 30%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                          @foreach($pharmacy as $pharma)
                          <option>{{$pharma->type->name}}</option>
                          @endforeach
                        </select>
                  </div>
            </div>
            <!-- /.card-body -->

           
                <button style="margin-left:30px ;width:150px"  type="submit" class="btn btn-success ">Create</button>
        </form>
    </div>


@endsection









