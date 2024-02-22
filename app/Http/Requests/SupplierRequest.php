<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'nama_supplier'     => 'required',
            'alamat'            => 'required',
            'email'             => 'required|email',
        ];
    
        return $rules;
    
    }

    public function messages()
    {
        return [
            'nama_supplier.required'    => 'Nama supplier wajib diisi.',
            'alamat.required'           => 'Alamat wajib diisi.',
            'email.required'            => 'Email wajib diisi.',
            'email.email'               => 'Format email tidak valid.'
        ];
    }
}
