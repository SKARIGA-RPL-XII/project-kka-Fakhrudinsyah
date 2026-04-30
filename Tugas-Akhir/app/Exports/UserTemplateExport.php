<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserTemplateExport implements WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'nis',
            'nama lengkap',
            'password',
            'role',
            'nama tempat pkl',
            'nama pembimbing'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}


