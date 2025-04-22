<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GamesTemplateExport implements FromArray, WithHeadings, WithStyles
{
    protected $equipesString;

    public function __construct($equipesString)
    {
        $this->equipesString = $equipesString;
    }

    public function array(): array
    {
        return [
            [
                'nombre_journee' => 1,
                'equipe_domicile_id' => 1,
                'equipe_exterieur_id' => 2,
                'date_match' => '2025-05-01', 
                'heure_match' => '15:00', 
                'stade' => 'Stade Municipal', 
                'status' => 'programmé', 
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'nombre_journee',
            'equipe_domicile_id',
            'equipe_exterieur_id',
            'date_match (optionnel)',
            'heure_match (optionnel)',
            'stade (optionnel)',
            'status (optionnel)',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('A20', 'Liste des équipes disponibles:');
        $sheet->setCellValue('A21', $this->equipesString);
        $sheet->setCellValue('A23', 'Valeurs possibles pour "status": programmé, , à venir');
        
        $sheet->getStyle('A10:A13')->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setWidth(50);
        
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
