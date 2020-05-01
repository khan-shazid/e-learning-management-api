<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegistrationRequestBody extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
     {
         return true;
     }

     /**
      * Get the validation rules that apply to the request.
      *
      * @return array
      */
      public function rules()
      {
          return [
            'name' => 'required|string|max:50',
            'email' => ['required','email',function($attribute, $value, $fail) {
                if (User::where('email',$value)->exists()) {
                  return $fail('Email already exists!');
                }
                return true;
            }],
            'password' => 'required|min:6'
          ];
      }

      public function messages()
      {
          return [
              'email.required' => 'Email is required!',
              'name.required' => 'Name is required!',
              'password.required' => 'Password is required!'
          ];
      }
      protected function failedValidation(Validator $validator)
      {
          $errors = $validator->errors();
          throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $errors
          ],422));
      }
}
