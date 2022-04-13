<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Models\Documents\Summaries\Summary;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;

class SummaryExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Summary::all();
    }

    public function headings(): array
    {
        return ['Id',
                'Nro.Res.',
                'Fecha',
                'Tipo',
                'Fiscal',
                'Estado Actual',
                'Usuario involucrado',
                'T. desde último evento'];
    }

    public function map($summary): array
    {
        return [
            $summary->id,
            $summary->resolution_number,
            $summary->summary_date,
            $summary->type,
            $summary->fiscal->user->getFullNameAttribute(),
            $summary->events->last()->status->name,
            $summary->events->last()->creator->getFullNameAttribute(),
            $summary->events->last()->event_date->diffForHumans(),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }



}
