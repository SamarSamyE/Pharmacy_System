<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\MedicineOrder;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
   public function index(OrdersDataTable $dataTable){
    return $dataTable->render('Admin.orders');
   }


   public function create(){
    $patients = Patient::all();
    $doctors = Doctor::all();
    $medicines = Medicine::all();
    $pharmacies = Pharmacy::all();
    // dd($pharmacy);
    return view('Orders.create',['patients'=>$patients , 'medicines'=>$medicines , 'pharmacies'=>$pharmacies , 'doctors'=>$doctors]);
   }




   public function store(Request $request){
   $order =new Order();
    $patient_address_id= PatientAddress::where('id',$request->patient_id)->first()->id;
    $order->patient_id=$request->input('patient_id');
    $order->pharmacy_id=$request->input('pharmacy_id');
    $order->doctor_id=$request->input('doctor_id');
    $order->patient_id=$request->input('patient_id');
    $order->patient_address_id=$patient_address_id;
    $order->is_insured=$request->input('is_insured');
    $order->price=0;

        if (auth()->user()->hasRole('admin')){
            $order->creator_type = 'admin';
        }
        if (auth()->user()->hasRole('pharmacy')){
            $order->creator_type = 'pharmacy';
        }
        if (auth()->user()->hasRole('doctor')){
            $order->creator_type = 'doctor';
        }
        if (auth()->user()->hasRole('patient')){
            $order->creator_type = 'patient';
        }

        $medicineOrder= new MedicineOrder();
        $medicineOrder->quantity=$request->input('quantity');
        $medicineOrder->medicine_id=$request->medicine_id;

        $order->price = Order::totalPrice($request->quantity, $request->medicine_id);
        $order->status="new";
        $order->save();

        $medicineOrder->order()->associate($order);
        $medicineOrder->save();
        return to_route('orders.index');
   }




   public function show($id){
        $order = Order::where('id', $id)->first();
        $medicineOrder=MedicineOrder::where('order_id',$id)->first();
        $medicine= Medicine::where('id',$medicineOrder->medicine_id)->first();

        return view('orders.show',compact('medicineOrder','order','medicine'));
   }



   public function edit($id)
   {
       $order= Order::find($id);
       $addresses=PatientAddress::all();
       $medicine=Medicine::all();
       $patients=Patient::all();
       return view('orders.edit', compact(['order','addresses','medicine','patients']));
   }


   public function update(Request $request, $id)
   {
       return redirect()->route('pharmacies.index');
   }




   public function destroy(Request $request, $id){
    dd($request);
    $order = Order::findOrFail($id);
    $orderImage= OrderImage::findOrFail($order->image->id);

    $order->delete();
    $orderImage->delete();
    return response()->json(['success'=>'User Deleted Successfully!']);
}
}
