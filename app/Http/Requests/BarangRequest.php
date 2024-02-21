<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'kode'          => 'required',
            'nama_barang'   => 'required',
        ];
    
        if (!empty($this->input('barangId'))) {
            $rules['kode'] .= '|unique:barang,kode,' . $this->input('barangId');
        } else {
            $rules['kode'] .= '|unique:barang,kode';
        }
    
        return $rules;
    
    }

    public function messages()
    {
        return [
            'kode.required'         => 'Kode wajib diisi.',
            'kode.unique'           => 'Kode telah digunakan.',
            'nama_barang.required'  => 'Nama barang wajib diisi.'
        ];
    }
}
