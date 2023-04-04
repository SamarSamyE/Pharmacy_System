<?php

namespace App\Http\Requests\Api;

use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
     {
        $id = auth()->user()->id;
        $user = User::find($id);
        $patient_id = Patient::find($user->typeable_id)->id;
        $addresses = PatientAddress::where('patient_id', $patient_id)->pluck('id')->toArray();

        return [
            //
            
            'is_insured'=>['required', Rule::in([0, 1])],
            'prescription.*'=>['required' , 'mimes:jpg,png' ],
            'patient_address_id'=>['required'] ,
        ];
    }
}
