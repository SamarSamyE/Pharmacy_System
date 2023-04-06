<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Patient;
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
       $pharmacy = Order::find($id);
//        $user = User::find($pharmacy->type->id);
// if (auth()->user()->hasRole('admin')) {
//    $pharmacy->priority = $request->input('priority');
//    $pharmacy->area_id = $request->input('area_id');
// }
// else if(auth()->user()->hasRole('pharmacy')){
//    $pharmacy->priority = auth()->user()->typeable->priority;
//    $pharmacy->area_id = auth()->user()->typeable->area_id;

// }
//        $pharmacy->national_id = $request->input('national_id');
//        $pharmacy->save();

//        $user->name = $request->input('name');
//        $user->email = $request->input('email');
//        if ($request->input('password')) {
//            $user->password = bcrypt($request->input('password'));
//        }
//        if ($request->hasFile('avatar')) {
//            if ($pharmacy->type->avatar) {
//                $avatarPath=$pharmacy->type->avatar;
//                Storage::delete('public/'.$avatarPath);
//            }
//            $avatar = $request->file('avatar');
//            $filename = time() . '.' . $avatar->getClientOriginalExtension();
//            $avatar->storeAs('public', $filename);
//            $user->avatar = $filename;
//        }
//        $user->save();

       return redirect()->route('pharmacies.index');
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
