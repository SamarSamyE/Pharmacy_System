<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SanctumTokenRequest;
use App\Http\Requests\Api\RegisterPatientRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Jobs\SendVerificationEmailJob;
use Illuminate\Auth\Events\Registered;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PatientVerification;
use Illuminate\Auth\Access\AuthorizationException;

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

      if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
        event(new Registered($user));
    }
       return new PatientResource($patient);
    }

    
    public function verify(Request $request, $id, $hash)
    {
        $client = Patient::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($client->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        $client->markEmailAsVerified();
        $client->save();
        $client->notify(new PatientVerification());
        return response()->json([
        'message' => 'Email verified successfully'
    ]);
}



    public function update(UpdatePatientRequest $request)
    { 
        $id = auth()->user()->id;
        $user = User::find($id);
        $patient = Patient::find($user->typeable_id);
        $patient->national_id = $request->national_id;
        $patient->gender = $request->gender;
        $patient->birth_date = $request->birth_date;
        $patient->mobile = $request->mobile;

        $patient->save();

        $user->name = $request->name;
        $user->password = $request->password;

      
        if ($request->hasFile('avatar')) {
            if ($patient->type->avatar) {
                $avatarPath=$patient->type->avatar;
                Storage::delete('public/'.$avatarPath);
            }
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public', $filename);
            $user->avatar = $filename;
        }

        $user->save();

       return new PatientResource($user);
    }

    

  

}
