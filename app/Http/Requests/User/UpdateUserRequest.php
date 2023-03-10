<?php

namespace App\Http\Requests\User;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class UpdateUserRequest extends FormRequest
{
    use ResponseTrait;
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required|min:8|max:255',
            'address' => 'required|string|min:10|max:255',
            'postcode' => 'required|numeric|digits_between:5,5',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'landmark' => 'required|string'
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): void
    {
           throw new HttpResponseException($this->validationError($validator->errors()->first()));
    }
}
