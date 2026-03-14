<?php

namespace App\Exports;

use App\Models\tes;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ListSheetExport implements FromArray, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $data = [
            ['', '', '', ''],
            ['No', 'Nama', 'Tanggal Tes', 'File Name'],
        ];

        $allData = tes::with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($allData as $i => $item) {
            $fileName = \Carbon\Carbon::parse($item->created_at)->format('Ymd_His');
            $data[] = [
                $i + 1,
                $item->user?->nama,
                \Carbon\Carbon::parse($item->tanggal_tes)->format('d-m-Y'),
                '=HYPERLINK("#\'Sheet-' . $fileName . '\'!A1","' . $fileName . '")'
            ];
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Header A1 - D1
                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', "Final Report");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 24],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(80);

                // Header kolom A2
                $sheet->setCellValue('A2', "No");
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom B2
                $sheet->setCellValue('B2', "Nama");
                $sheet->getStyle('B2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom C2
                $sheet->setCellValue('C2', "Tanggal Tes");
                $sheet->getStyle('C2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom D2
                $sheet->setCellValue('D2', "File Name");
                $sheet->getStyle('D2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                $style = [
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center'
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle("A1:D2")->applyFromArray($style);
                $sheet->getStyle("A1:D{$lastRow}")->applyFromArray($style);


                // Style Nama left
                $sheet->getStyle('B3:B' . $lastRow)->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => [
                        'horizontal' => 'left',
                        'vertical' => 'center',
                        'wrapText' => true
                    ],
                ]);

                // Kolom A - D Lebarnya menyesuaikan konten
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
            },
        ];
    }

    public function title(): string
    {
        return 'List All Data';
    }
}
