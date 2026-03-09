<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'prodi' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'campus' => ['required', 'string', 'in:Kampus Pusat,Kampus 2 Bondowoso'],
            'division_id' => ['required', 'exists:divisions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'prodi.required' => 'Program studi wajib diisi',
            'domisili.required' => 'Domisili wajib diisi',
            'campus.required' => 'Kampus wajib dipilih',
            'division_id.required' => 'Divisi wajib dipilih',
            'division_id.exists' => 'Divisi yang dipilih tidak valid',
        ];
    }
}
