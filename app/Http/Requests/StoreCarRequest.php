<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCarRequest extends FormRequest
{
    // protected $stopOnFirstFailure = true;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'color' => ['required', 'string'],
            'year' => ['required', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'brand.required' => 'Informe a marca do veículo',
            'model.required' => 'Informe o modelo do veículo',
            'color.required' => 'Informe a cor do veículo',
            'year.required' => 'Informe o ano de fabricação do veículo',
            'year.integer' => 'O ano de fabricação informado não está em um formato válido'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true,
        ], 422));
    }
}
