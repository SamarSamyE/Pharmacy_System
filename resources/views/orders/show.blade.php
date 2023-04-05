
<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Show Order Number {{$order->id}} </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
        <div class="form-group">
                    <label>patient Name</label>
                    <input type="text" value="{{$order->patient->type->name}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Is Insured ?</label>
                    <input type="text" value="{{$order->is_insured}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Pharmacy</label>
                    <input type="text" value="{{$order->pharmacy->type->name ?? ''}}" class="form-control" disabled>
                </div>
                
                

                <div class="form-group">
                    <label for="user-name">Doctor ID</label>
                    <input type="text" value="{{$order->doctor->id}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="user-name">Status</label>
                    <input type="text" value="{{$order->status}}" class="form-control" disabled>
                </div>



                <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-group">

                    <p value="{{$medicine->id}}">Medicine: {{$medicine->name}}</p>
    
                    <p value="{{$medicine->id}}">quantity: {{$medicine->quantity}}</p>



            </div>
            <!-- /.card-body -->


        </form>
    </div>


