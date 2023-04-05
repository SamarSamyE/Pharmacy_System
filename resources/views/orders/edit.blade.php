

<div class="card card-primary">
        
          <div class="card-header">
            <h3 class="card-title">Update Order Number:{{$order->id}}</h3>
        </div>
        
        <!-- /.card-header -->
        <!-- form start -->
  
        <form class = "form-vertical" role = "form" action="{{route('Orders.update',$order->id)}}" method="POST" enctype="multipart/form-data">

          @csrf
          @method('PUT')

          <div class="card-body">

              <div class="form-group" data-select2-id="13">
                  <label>Order Status</label>
                  <input type="text" class="form-control" value="{{$order->status}}" disabled>
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
                  <label >Is insured ?</label>
                  <select name="is_insured" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option {{$order->is_insured == 1 ? 'selected' : '' }}>Yes</option>
                    <option {{$order->is_insured == 0 ? 'selected' : '' }}>No</option>
                  </select>
                </div>



                <div class="form-group">
                  <label >Change patient Name</label>
                  <select name="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      
                      @foreach($users as $user)
                      <option value="{{$user->id}}" {{$order->patient_id === $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                      @endforeach
                  </select>
              </div>
              {{-- <div class="form-group">
                <label >Change patient Name</label>
                <select name="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    
                    @foreach($doctors as $doctors)
                    <option value="{{$doctors->id}}">{{$doctors->name}}</option>
                    @endforeach
                </select>
            </div> --}}
              <div class="form-group">
                <label for="pharmacy_id">Change Pharmacy Name</label>
                <select name="pharmacy_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    
                    @foreach($pharmacy as $phar)
                    <option value="{{$phar->id}}" {{$order->pharmacy_id === $phar->id ? 'selected': ''}}>{{$phar->type->name}}</option>
                    @endforeach
                </select>
            </div>


         </div>

         <div class="card-footer">
          <button type="submit" class="btn btn-dark w-100">Update</button>
      </div>

    </form>








