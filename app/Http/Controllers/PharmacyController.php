<?php

namespace App\Http\Controllers;

use App\DataTables\PharmaciesDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\PatientAddress;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PharmacyController extends Controller
{

    public function index(PharmaciesDataTable $dataTable)
    {
        return $dataTable->render('Admin.pharmacies');
    }

    public function show($id)
    {
        $pharmacy = Pharmacy::where('id', $id)->first();
        return view('pharmacies.show',['pharmacy' => $pharmacy]);
    }

    public function create()
    {
        return view('pharmacies.create');
    }
    public function edit($id)
    {
        $pharmacy = Pharmacy::find($id);
        return view('pharmacies.edit', compact('pharmacy'));
    }
    public function update(StoreUserRequest $request, $id)
    {
        $pharmacy = Pharmacy::find($id);
        $user = User::find($pharmacy->type->id);
if (auth()->user()->hasRole('admin')) {
    $pharmacy->priority = $request->input('priority');
    $pharmacy->area_id = $request->input('area_id');
}
else if(auth()->user()->hasRole('pharmacy')){
    $pharmacy->priority = auth()->user()->typeable->priority;
    $pharmacy->area_id = auth()->user()->typeable->area_id;

}
        $pharmacy->national_id = $request->input('national_id');
        $pharmacy->save();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if ($request->hasFile('avatar')) {
            if ($pharmacy->type->avatar) {
                $avatarPath=$pharmacy->type->avatar;
                Storage::delete('public/'.$avatarPath);
            }
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public', $filename);
            $user->avatar = $filename;
        }
        $user->save();

        return redirect()->route('pharmacies.index');
    }

    public function store(StoreUserRequest $request)
    {

        $user = new User([
        'name'=>$request->input('name'),
        'email'=>$request->input('email'),
        'password'=>$request->input('password'),
        ]);
        if ($request->hasFile('avatar')) {
            $avatar =$request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public', $filename);
            $user->avatar = $filename;
        }

        $pharmacy= new Pharmacy([
            'priority'=>$request->input('priority'),
            'area_id'=>$request->input('area_id'),
            'national_id'=>$request->input('national_id')
        ]);
        $pharmacy->save();
        $user->typeable()->associate($pharmacy);
        $user->save();
        return to_route('pharmacies.index');
    }

    public function destroy(Request $request, $id){
        $pharmacy = Pharmacy::findOrFail($id);
        $user = User::findOrFail($pharmacy->type->id);
        $pharmacyOrders = Order::where('pharmacy_id', $id)->whereNotIn('status', ['Delivered', 'Canceled', 'Confirmed'])->orWhereNull('status')->get();


        if( ! count($pharmacyOrders) > 0 ){
            $pharmacy->delete();
            $user->delete();
            return response()->json(['success'=>'Pharmacy Deleted Successfully!']);
        }
        else{
            Session::flash('alert', 'Your alert message here');
            Session::flash('alert-type', 'error');

            // Return JSON response with the alert message and type
            return response()->json([
                'error' => true,
                'message' => 'you can not delete this pharmacy',
                'type' => 'error'
            ]);

        }
    }

    public function showTrashed(){
        $deletedPharmacies = Pharmacy::onlyTrashed()
        ->with(['type' => function ($user) {
        $user->withTrashed();}])->get();
        return view('pharmacies.trashed', compact('deletedPharmacies'));
    }

    public function restoreTrashedPharmacies($id){
    $pharmacy = Pharmacy::onlyTrashed()->findOrFail($id);
    $user=User::findByPharmacy($pharmacy);
    $pharmacy->restore();
    $user->restore();
    return to_route('pharmacies.index');
    }

    public function forceDeleteTrashedPharmacies($id){
    $pharmacy = Pharmacy::onlyTrashed()->findOrFail($id);
    $user=User::findByPharmacy($pharmacy);
    $pharmacy->forceDelete();
    $user->forceDelete();
    return redirect()->back();
}
}
