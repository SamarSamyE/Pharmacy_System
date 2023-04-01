<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PharmacyController extends Controller
{

    public function index()
    {
        $allpharmacies =Pharmacy::all();
        // dd($allpharmacies);
        return view('Admin.pharmacies', ['pharmacies' => $allpharmacies]);
    }

    public function show($id)
    {
        $pharmacy = Pharmacy::where('id', $id)->first();
        return view('pharmacies.show',['pharmacy' => $pharmacy]);
    }

    public function create()
    {
        // $users = User::all();
        return view('pharmacies.create');
    }
    public function edit($id)
    {
        $pharmcy = Pharmacy::find($id);
        return view('pharmacies.edit', compact('pharmacy'));
    }
public function update(Request $request, $id)
{
    $pharmacy = Pharmacy::find($id);
    $pharmacy->password = $request->input('password');
    $pharmacy->email = $request->input('email');
    $pharmacy->national_id = $request->input('national_id');
    $pharmacy->priority = $request->input('priority');
    $pharmacy->area_id = $request->input('area_id');

    if ($request->hasFile('avatar')) {
        if ($pharmacy->avatar) { /////the avatar path for this pharmacy
            $avatarPath=$pharmacy->avatar;
            Storage::delete('public/'.$avatarPath);
        }
        $avatar = request()->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('public/', $filename);
        $pharmacy->avatar = $filename;
    }
    $pharmacy->save();
    return redirect()->route('pharmacies.index');
}

    public function store(Request $request)
    {

        $pharmacy=new Pharmacy();
        $user = new User([
        'name'=>$request->input('name'),
        'email'=>$request->input('email'),
        'password'=>$request->input('password'),
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = request()->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public', $filename);
            $user->avatar = $filename;
        }

        $pharmacy= new Pharmacy([
            'priority'=>$request->input('priority'),
            'area_id'=>$request->input('area_id'),
            'national_id'=>$request->input('national_id')
        ]);
        // $user->name = $request->input('name');
        // $user->password = $request->input('password');
        // $user->email = $request->input('email');
        // $pharmacy->national_id = $request->input('national_id');
        // $pharmacy->priority = $request->input('priority');
        // $pharmacy->area_id = $request->input('area_id');
        $pharmacy->save();
        $user->typeable()->associate($pharmacy);
        $user->save();
        return to_route('pharmacies.index');
    }

    public function destroy(Request $request, $id)
{
    $pharmacy = Pharmacy::findOrFail($id);
    if ($pharmacy->avatar) {
        $avatarPath=$pharmacy->avatar;
        Storage::delete('public/'.$avatarPath);
    }
    $pharmacy->delete();
    return redirect()->route('pharmacies.index');
  }
}
