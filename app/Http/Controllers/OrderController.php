<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Pharmacy;
use App\Models\Order;



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
        $doctors = User::Role('doctor')->get();
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
        $Order=new Order();
        $PatientAddress= new PatientAddress();
        // $data = $request->all();
        // dd($data);
        // $userId = User::all()->where('name', $data['name'])->first()->id;
        // dd($userId);
        $userId=$Order->patient->id;
        dd($userId);
        $docId = User::all()->where('name', $data['DocName'])->first()->id;
        // dd($docId);
        $pharmacyId = Pharmacy::all()->where('name', $data['PharmacyName'])->first()->id;

        
        $order = Order::create([
            'patient_id'=>$request-> $userId,
            
            'doctor_id' => $docId,
            'is_insured' => $request->is_insured ? $request->is_insured : 0,
            'status' => 'new',
            'pharmacy_id' =>$pharmacyId,
            // 'Actions' => '--',
            'creator_id' => 2
        ]);

        return redirect("/orders/$order->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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