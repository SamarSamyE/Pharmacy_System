<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\User;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    //
    public function index () {

        $id = auth()->user()->id;
        $user = User::find($id);
        $patient = Patient::find($user->typeable_id);
        $patient_id = $patient->id;
        $allAddresses = PatientAddress::where("patient_id" , $patient_id)->get(); 
        return $allAddresses;
    }

    public function show (Request $request , string $id) {
      $address  = PatientAddress::where('id', $id)->get();
      return $address;
    }
    

    public function store (Request $request){
        $id = auth()->user()->id;
        $user = User::find($id);
        $patient_id = Patient::find($user->typeable_id)->id;
        
        $address = new PatientAddress([
            'patient_id' => $patient_id,
            'street_name' => $request->street_name,
            'build_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->is_main,
            'area_id' => $request->area,
        ]);
       $address->save();
        return $address;


    }

    public function update(Request $request , string $id) {
        $address  = PatientAddress::find($id);
        $address->area_id = $request->area_id;
        $address->street_name = $request->street_name;
        $address->build_number = $request->building_number;
        $address->floor_number = $request->floor_number;
        $address->flat_number = $request->flat_number;
        $address->is_main = $request->is_main;

        $address->save();


        return $address;
      }


      public function destroy (string $id) {
        $address  = PatientAddress::find($id);
        $address->delete();

        return [
            'msg' => 'Address deleted!'
        ];
    }

}
