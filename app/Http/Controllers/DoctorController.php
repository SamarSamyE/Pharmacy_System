<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;

class DoctorController extends Controller
{
    //create doc fns
    public function index()
    {
        $allDoctors = Doctor::get();
        return view('pharmacy/Doctors/index', ['Doctor' => $allDoctors]);

    }

    public function create()
    {
        $doctor = Doctor::all();
        //to be dynamic dropdown

        return view('pharmacy/Doctors/create', ['doctor' => $doctor]);
    }



    public function show($id)
   {
 $doctor = Doctor::where('id', $id)->first();

    // dd($doctor);
    return view('pharmacy/Doctors/show', ['doctor' => $doctor]);

// $data = 'this is a test';
// return view('pharmacy/Doctors/show', compact(['data']));


    }


    public function edit($id)//when i click on edit so to go to that post im clicking on ive to send id of that post

    {
        $doctor = Doctor::find($id);

        return view('pharmacy/Doctors/edit', compact('doctor'));
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

    return redirect()->route('Doctors.index');



}

    public function store(Request $request)
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

        return to_route('Doctors.index');


    }

    public function destroy(Request $request, $id)
{


        $doc = Doctor::findOrFail($id);//is the id exists or not
        $doc->delete();
        return redirect()->route('Doctors.index');


  }

}
