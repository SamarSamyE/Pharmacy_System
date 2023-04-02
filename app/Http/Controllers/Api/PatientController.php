<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SanctumTokenRequest;
use App\Http\Requests\Api\RegisterPatientRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
   
    public function login(SanctumTokenRequest $request){
           
            $email = $request->email;

            $user = User::where('email', $email)->first();
        if (!$user || ($request->password != $user->password)){
                return response([
                    'msg' => 'incorrect email or password'
                ], 401);
            }

           
    
            $token = $user->createToken('apiToken')->plainTextToken;

   return (new PatientResource($user))->setToken($token);

   }

    public function register(RegisterPatientRequest $request)
    {
  
        $patient=new Patient();
        $user = new User([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password
        ]);
        if ($request->hasFile('avatar')) {

            $avatar =$request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public', $filename);
            $user->avatar = $filename;
        }

        $patient= new Patient([
            'national_id'=>$request->national_id,
            'gender'=>$request->gender,
            'birth_date'=>$request->birth_date,
             'mobile'=>$request->mobile
        ]);

        $patient->save();
        $user->typeable()->associate($patient);
        $user->save();

       return new PatientResource($patient);
    }

  

}
