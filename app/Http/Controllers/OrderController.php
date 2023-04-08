<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Jobs\OrderConfirmationJob;
use App\Mail\OrderConfirmationMail;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\MedicineOrder;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            $order->pharmacy_id=auth()->user()->typeable_id;

        }
        if (auth()->user()->hasRole('doctor')){
            $order->creator_type = 'doctor';
            $order->doctor_id=auth()->user()->typeable_id;
            $order->pharmacy_id=auth()->user()->typeable->pharmacy_id;
           }
        if (auth()->user()->hasRole('patient')){
            $order->creator_type = 'patient';
            $order->patient_id=auth()->user()->typeable_id;
        }

        $quantity = array_map('intval', $request->qun);
        $orderMedicine = $request->medicine_id;
        $order->status="processing";
        $order->save();
        Order::createOrderMedicine($order, $quantity, $orderMedicine);
        $order->price = Order::totalPrice($quantity, $orderMedicine);
        $confirmUrl=url("stripe/{order}");
        $cancelUrl=url("/orders/$order->id/cancelled");
        Mail::to("samarsamy@gmail.com")->send(new OrderConfirmationMail($order,$order->patient->type,$confirmUrl,$cancelUrl));
        return to_route('orders.index');
   }




   public function show($id){
        $order = Order::where('id', $id)->first();
        $medicineOrder=MedicineOrder::where('order_id',$id)->first();
        $medicine= Medicine::where('id',$medicineOrder->medicine_id)->first();

        return view('orders.show',compact('medicineOrder','order','medicine'));
   }



   public function edit($id){
        $order= Order::findOrFail($id);
        $addresses=PatientAddress::all();
        $medicines=Medicine::all();
        $patients=Patient::all();
        $PastPatient=Patient::find($order->patient)->first()->type->name;
        $pharmacies=Pharmacy::all();
        $PastPharmacy=Pharmacy::where('id',$order->pharmacy_id)->first();
        $PastDoctor=Doctor::where('id',$order->doctor_id)->first();
        $medicineOrder=MedicineOrder::where('order_id',$id)->first();
        $pastMedicine= Medicine::where('id',$medicineOrder->medicine_id)->first();
        // dd($medicine);

        $doctors=Doctor::all();
        return view('orders.edit', compact(['order','addresses','medicines','patients','pharmacies','doctors','PastPatient','pastMedicine','PastPharmacy','PastDoctor']));
   }


   public function update(Request $request, $id)
   {

    $order =Order::find($id);
  if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('pharmacy') ||auth()->user()->hasRole('patient')) {
    $patient_address_id= PatientAddress::where('id', $request->patient_id)->first()->id;
    $order->patient_id=$request->input('patient_id');
    $order->pharmacy_id=$request->input('pharmacy_id');
    $order->doctor_id=$request->input('doctor_id');
    // $order->patient_id=$request->input('patient_id');
    $order->patient_address_id=$patient_address_id;
    $order->is_insured=$request->input('is_insured');
    $order->price=0;
    // $medicineOrder= MedicineOrder::where('order_id', $order->id)->first();
    // $medicineOrder->quantity=$request->input('quantity');
    // $medicineOrder->medicine_id=$request->medicine_id;

    // $order->price = Order::totalPrice($request->quantity, $request->medicine_id);

    if (auth()->user()->hasRole('admin')) {
        $order->creator_type = 'admin';
    }
    if (auth()->user()->hasRole('pharmacy')) {
        $order->creator_type = 'pharmacy';
        $order->pharmacy_id=auth()->user()->typeable_id;
    }

    if (auth()->user()->hasRole('patient')) {
        $order->creator_type = 'patient';
        $order->patient_id=auth()->user()->typeable_id;
    }
    $editedQuantity = array_map('intval', $request->qun);
    $editedOrderMedicine = $request->medicine_id;

    $order->status= $request->input('status');

    // if ($order->status == "WaitingForUserConfirmation") {
    //     $enduser2 = User::where('id', '=', $order->patient->type->id)->first();
    //     dispatch(new OrderConfirmationJob($enduser2, $order));
    // }

    $order->save();
    Order::updateOrderMedicine($order, $editedQuantity, $editedOrderMedicine);
    $order->price = Order::totalPrice($editedQuantity, $editedOrderMedicine);
    }


    else if (auth()->user()->hasRole('doctor')){
        $order->creator_type = 'doctor';
        $order->doctor_id=auth()->user()->typeable_id;
        $PharmacyId=$order->pharmacy_id;

        $order->pharmacy_id=$PharmacyId;

        $patient_address_id= PatientAddress::where('id', $order->patient_id)->first()->id;
        $order->patient_address_id=$patient_address_id;
        $isInsured=$order->is_insured;
        $order->is_insured=$isInsured;
        $patientId=$order->patient_id;
        $order->patient_id=$patientId;
        $order->price=0;
        $medicineOrder= MedicineOrder::where('order_id', $order->id)->first();
        $medicineOrder->quantity=$order->medicineOrder->quantity;
        $order->save();
        $medicineOrder->medicine_id=$order->medicineOrder->medicine_id;
        $order->price = Order::totalPrice($order->medicineOrder->quantity, $order->medicineOrder->medicine_id);
        $medicineOrder->save();
    }

        return to_route('orders.index');
   }

   public function confirm($id){

   }

   public function cancel($id){
    $order=Order::find($id);
    $order->status="Canceled";
    $order->save();


   }



   public function destroy(Request $request, $id){
    $order = Order::findOrFail($id);
    $medicineOrder = MedicineOrder::where('order_id',$id);

    $order->delete();
    $medicineOrder->delete();

    return response()->json(['success' => 'Order deleted successfully!' ]);
}
}
