<div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update Order Number:{{$order->id}}</h3>
        </div>

        <!-- /.card-header -->
        <!-- form start -->

        <form class = "form-vertical" role = "form" action="{{route('orders.update',$order->id)}}" method="POST" enctype="multipart/form-data">

          @csrf
          @method('PUT')
        <div class="card-body">
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
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Delivery Address</label>
        <select style="width:30%" name="patient_address_id" class="form-control" >
          @foreach($addresses as $address)
              <option value="{{$address->id}}">{{$address->street_name}}</option>
          @endforeach
      </select>
      </div>
        @if($order->status != 'Waiting')
            <div class="form-group" data-select2-id="13">
                <label for="status">status</label>
                <select name="status" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option>{{$order->status}}</option>
                    <option>Processing</option>
                    <option>Confirmed</option>
                    <option>Delivered</option>
                    <option>Canceled</option>
                    <option>WaitingForUserConfirmation</option>
                </select>
            </div>
        @endif
            <div class="form-group" data-select2-id="13">
                <label for="Patientname">Choose the User</label>
                <select name="Patientname" class="form-control select2 select2-hidden-accessible" style="width: 30%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{$patient->type->name}}</option>
                    @endforeach
                </select>
            </div>

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
        <!-- /.card-body -->


                <button style="margin-left:30px ;width:150px"  type="submit" class="btn btn-success ">Create</button>
        </form>
    </div>

    </div>

<div class="card-footer">
 <button type="submit" class="btn btn-dark w-100">Update</button>
</div>

</form>


















