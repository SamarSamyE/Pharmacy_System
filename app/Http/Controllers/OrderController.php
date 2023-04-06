<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\PatientAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
   public function index(OrdersDataTable $dataTable){
    return $dataTable->render('Admin.orders');
   }


   public function create(){
    $addresses=PatientAddress::all();
    return view('orders.create',compact('addresses'));
   }


   public function store(Request $request){
    $order = new Order();

    $order->is_insured = request()->radio;
    $order->status = 'new';
    $order->patient_address_id = request()->patient_address_id;
    $order->patient_id =auth()->user()->id;
    $order->price= 0;
     //if admin
    if (auth()->user()->hasRole('admin')) {
        $order->creator_type = 'admin';
        //if patient
    } else if(auth()->user()->hasRole('patient')){
        $order->creator_type = 'patient';
    }
    $order->save();

    $Prescriptions = $request->file("avatar");
    $paths = [];
    if ($Prescriptions) {
        foreach ($Prescriptions as $Prescription) {
            $paths[] =
             Storage::putFileAs(
                'public/prescriptions',
                 $Prescription,
                  $Prescription->getClientOriginalName()
            );
        }
    }
    $serializedPaths = serialize($paths);
        OrderImage::create([
            'order_id' => $order->id,
            'image' => $serializedPaths
        ]);

        return to_route("orders.index");
   }


   public function destroy(Request $request, $id){
    dd($request);
    $order = Order::findOrFail($id);
    $orderImage= OrderImage::findOrFail($order->image->id);
      // $orderImage= OrderImage::findOrFail($order->image->id);
    $order->delete();
    $orderImage->delete();
    return response()->json(['success'=>'User Deleted Successfully!']);
}
}
