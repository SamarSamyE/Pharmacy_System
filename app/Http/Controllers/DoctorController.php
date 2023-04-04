<?php

namespace App\Http\Controllers;

use App\DataTables\DoctorsDataTable;
use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;

class DoctorController extends Controller
{
    //create doc fns
    public function index(DoctorsDataTable $dataTable)
    {
        return $dataTable->render('Admin.doctors');

    }

    public function create()
    {
        $doctor = Doctor::all();
        return view('doctors.create', ['doctor' => $doctor]);
    }



    public function show($id)
   {
 $doctor = Doctor::where('id', $id)->first();

    // dd($doctor);
    return view('doctors.show', ['doctor' => $doctor]);

// $data = 'this is a test';
// return view('pharmacy/Doctors/show', compact(['data']));


    }


    public function edit($id)//when i click on edit so to go to that post im clicking on ive to send id of that post

    {
        $doctor = Doctor::find($id);

        return view('doctors.edit', compact('doctor'));
    }


public function update(Request $request, $id)
{
    $doctor = Doctor::find($id);
    $user = User::find($doctor->type->id);

    $doctor->pharmacy_id = $request->input('pharmacy_id');
    $doctor->national_id = $request->input('national_id');
    $doctor->save();

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    if ($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
    }
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('public', $filename);
        $user->avatar = $filename;
    }
    $user->save();

    return redirect()->route('doctors.index');



}

    public function store(StoreUserRequest $request)
    {

//   $doctor=new Doctor();
  $user = new User([

'name'=>$request ->input('name'),
'email'=>$request ->input('email'),
'password'=>$request ->input('password')
  ]);

  if($request->hasFile('avatar')){

    $avatar=request()->file('avatar');
    $filename=time(). '.' . $avatar->getClientOriginalExtension();
    $avatar->storeAs('public',$filename);
    $user->avatar= $filename;
  }
  $doctor=new Doctor([
    'national_id' => $request->input('national_id'),
    'pharmacy_id' => $request->input('pharmacy_id')


  ]);

  $doctor->save();
  $user->typeable()->associate($doctor);
  $user->save();

//   $doctor->national_id = $request->input('national_id');
//   $doctor->type->name = $request->input('name');
//   $doctor->type->email = $request->input('email');
//   $doctor->is_banned = $request->input('is_banned');

        return to_route('doctors.index');


    }

    public function destroy(Request $request, $id)
{

        $doctor = Doctor::findOrFail($id);
        $user = User::findOrFail($doctor->type->id);
        $doctor->delete();
        $user->delete();
        return response()->json(['success'=>'User Deleted Successfully!']);

  }

}
