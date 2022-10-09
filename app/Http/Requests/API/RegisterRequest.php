<?php

namespace App\Http\Requests\API;

use App\Http\Responses\JsonResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            (new JsonResponser())->failure('bad request', $validator->errors(), 422)
        );
    }

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|string|unique:customers,email',
            'whatsapp'  => 'required|string|unique:customers,whatsapp',
            'card_uuid' => 'required',
        ];
    }
}
