<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use App\Models\Medicine;
use App\Models\Pharmacy;
use App\Models\User;
class MedicineController extends Controller
{

    public function index()
    {
        $allMedicines = Medicine::get();
       
            return view('pharmacy/Medicines/index', ['Medicine' => $allMedicines]);

    }

    public function show($id)
    {
        
        $medicine = Medicine::where('id', $id)->first();
        return view('pharmacy/Medicines/show', ['medicine' => $medicine]);
       


    }

    public function create()
    {
        $medicine = Medicine::all();
        //to be dynamic dropdown

        return view('pharmacy/Medicines/create', ['medicine' => $medicine]);
    }

    public function edit($id)//when i click on edit so to go to that post im clicking on ive to send id of that post
    
    {
        $medicine = Medicine::find($id);
      
        return view('pharmacy/Medicines/edit', compact('medicine'));
    }
    public function update(Request $request, $id)
    {
        $medicine = Medicine::find($id);
        
      
        $medicine->id = $request->input('id');
        $medicine->type = $request->input('type');
        $medicine->name = $request->input('name');
        $medicine->price = $request->input('price');
        $medicine->quantity = $request->input('quantity');
        $medicine->save();
    
       // put here order medicine after we add relation on it 
    
        return redirect()->route('Medicines.index');
    
    
    
    }
    

    public function store(Request $request)
    {
       
        $medicine=new Medicine([
            // 'id' =>  $request->input('id'),
            'type' => $request->input('type'),
            'name'=> $request->input('name'),
            'price'=> $request->input('price'),
            'quantity'=> $request->input('quantity')


        ]);

        $medicine->save();


        return to_route('Medicines.index');


    }

    public function destroy(Request $request, $id)
    {
       
    
            $medicine = Medicine::findOrFail($id);//is the id exists or not
            $medicine->delete();
            return redirect()->route('Medicines.index');
    
    
      }
    
      //
}
