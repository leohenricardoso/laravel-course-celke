<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BillRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'bill_value' => 'required|decimal:2',
            'due_date' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'bill_value.required' => 'Bill value is required.',
            'bill_value.decimal' => 'Bill value type must be numeric - decimal.',
            'due_date.required' => 'Due date is required.',
            'due_date.date' => 'Due date type must be date.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'status' => false,
                'errors' => $validator->errors()
            ], 422
        ));
    }
}
