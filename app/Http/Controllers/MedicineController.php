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

       


    }
public function update(StoreUserRequest $request, $id)
{
   



}

    public function store(StoreUserRequest $request)
    {
       




    }

    public function destroy(Request $request, $id)
{
   

}
    //
}
