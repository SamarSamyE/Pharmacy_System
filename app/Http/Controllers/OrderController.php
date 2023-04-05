<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Medicine;
use App\Models\MedicineOrder;
use App\Models\Pharmacy;
use App\Models\Order;
use App\Models\PatientAddress;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('Orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $patients = Patient::all();
        // dd($patients);
        $doctors = Doctor::all();
        $medicine = Medicine::all();
        $pharmacy = Pharmacy::all();
        // dd($pharmacy);
        return view('Orders.create',['patients'=>$patients , 'medicine'=>$medicine , 'pharmacy'=>$pharmacy , 'doctors'=>$doctors]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
       $quan = $request->quantity;
        $patient_id =$request->Patientname;
        $patient_address_id= PatientAddress::where('id',$patient_id)->first();

        $Medicine_id = $request->medicines;

        //dd($Medicine_id);
         //dd($patient_address_id->id);
        $Order=new Order(
            [
                'pharmacy_id' => $request->input('PharmacyName'),
                'doctor_id' => $request->input('DocName'),
                'patient_id'=>$request->input('Patientname'),
                'is_insured' => $request->has('is_insured')? 1:0,
                'status'=>"new",
                'creator_type'=>$request->input('creator_type'),
                'patient_address_id'=>$patient_address_id->id,
                'price'=>0


            ]
        );    //is_insured , is_insured  , name,Patientname, pharmacy_id,doctor_id ,patient_id


        $MedicineOreder= new MedicineOrder(
           [ 
            'quantity' => $request->input('quantity'),
            'medicine_id'=>$Medicine_id 
           ]

        );

       $Order->price = Order::totalPrice($quan, $Medicine_id);

        $Order->save();
        $MedicineOreder->order()->associate($Order);
        $MedicineOreder->save();
        return redirect()->route('Orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
    
        $order = Order::find($id);
        //dd($order->medicineOrder->medicine_id);
        $medicineorder = MedicineOrder::where('order_id',$order->id)->first();
        $medicine = Medicine::where('id',$medicineorder->medicine_id)->first();
        //dd($medicine);
        // dd($order);
        //dd($medicineorder);

        return view('orders.show',['order'=>$order,'medicine'=>$medicine]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {
      
        $order = Order::find($id);
        // dd($order->id);
        $users = User::all();
        // dd($patients);  
        $doctors = Doctor::all();
        //dd($doctors);
        $pharmacy = Pharmacy::all();
        return view('Orders.edit', ['order' => $order, 'users' => $users, 'pharmacy' => $pharmacy, 'doctors' => $doctors]);
     }

    public function update(Request $request,$id)
    {
        //dd($id);
        $order = Order::find($id);
        //dd($order);
        $order->update([
            'pharmacy_id' => $request->pharmacy_id,
            'doctor_id' => $request->doctor_id,
            'status' => $request->status,
            'is_insured' => $request->has('is_insured') ? 1 : 0,
            'price'=>$order->price,
            'patient_id'=>$order->patient_id,
            'patient_address_id'=>$order->patient_address_id
            
        ]);
        return redirect()->route('Orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}