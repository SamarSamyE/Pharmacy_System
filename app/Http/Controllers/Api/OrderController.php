<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //get all orders
    public function index(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $patient_id = Patient::find($user->typeable_id)->id;

        $allOrders = Order::where("patient_id" , $patient_id)->get(); 
        return $allOrders;
    }
    //get order by id
    public function show ( string $id){
        $order  = Order::where('id', $id)->get();
        return $order;
    } 
    
    //to update order
    public function update(Request $request , string $id) 
    {  
        $order  = Order::find($id);
        if($order->status == 'New'){
            $order->patient_address_id = $request->patient_address_id;
            $order->status = 'New';

            $order->save();

            if ($request->hasFile('orderImg')) {
              
                
                $files = $request->file('orderImg');
                 // dd($files);
                  $path = $files->store('order-'.$order->id );
   
                   $image = new OrderImage([
                       'order_id'=> $order->id ,
                       'image'=> $path,
                   ]);
                  
                   $image->save();
             
           }

            return $order;
        }
   


     return ['msg'=> "Can't Update"];
   }

   // Creating an Order
    public function store(Request $request)
    {   
        $id = auth()->user()->id;
        $user = User::find($id);
        $patient_id = Patient::find($user->typeable_id)->id;
        $addresses = PatientAddress::where('patient_id', $patient_id)->pluck('id')->toArray();
        $order = new Order([
             'is_insured'=> $request->has('is_insured')? 1:0,
             'status'=> 'new',
            'patient_id'=> $patient_id,
            'patient_address_id' => $request->address_id || 1,
            'price'=> 0

        ]);
       

        $order->save();

        if ($request->hasFile('prescription')) {


            $files = $request->file('prescription');
        

                $path = $files->store('order-'.$order->id );

                $image = new OrderImage([
                    'order_id'=> $order->id ,
                    'image'=> $path,
                ]);
               
                $image->save();
          
        }


        return $order;
    }


    //Deleting an order
    public function destroy (string $id) {
        $order = Order::find($id);
        $order->delete();

        return [
            'msg' => 'order deleted!'
        ];
    }

}
