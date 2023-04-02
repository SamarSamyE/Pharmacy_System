<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueNationalId;

class StoreUserRequest extends FormRequest
{
    // protected $table;
    // public function __construct($table){
    //     $this->table=$table;
    // }
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
        return [
                'national_id' => ['required',new UniqueNationalId],
                'password'=>['required','size:6'],
                'avatar' =>['max:2048', 'mimes:jpeg,jpg'],
            ];
    }
}
