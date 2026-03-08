<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registration::with('division')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Jurusan',
            'Prodi',
            'Domisili',
            'Kampus',
            'Divisi',
            'Tanggal Daftar',
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->name,
            $registration->jurusan,
            $registration->prodi,
            $registration->domisili,
            $registration->campus,
            $registration->division->name,
            $registration->created_at->format('d/m/Y H:i'),
        ];
    }
}
