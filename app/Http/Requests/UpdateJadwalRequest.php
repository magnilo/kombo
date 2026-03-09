<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'division' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul jadwal wajib diisi',
            'date.required' => 'Tanggal wajib diisi',
            'time.required' => 'Waktu wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
        ];
    }
}
