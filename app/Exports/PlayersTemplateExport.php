<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlayersTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        return [
            [
                'prenom' => 'Jean',
                'nom' => 'Deep',
                'nationalite' => 'Française',
                'date_naissance' => '1998-05-12',
                'telephone' => '0654347689',
                'email' => 'ousstest6@example.com',
                'password' => 'password123',
                'numero_maillot' => '10',
                'position' => 'attaquant',
                'statut' => 'actif',
                'photo' => 'https://example.com/photos/joueur1.jpg', 

            ]
        ];
    }

    public function headings(): array
    {
        return [
            'prenom',
            'nom',
            'nationalite',
            'date_naissance',
            'telephone',
            'email',
            'password',
            'numero_maillot',
            'position',
            'statut',
            'photo',

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
