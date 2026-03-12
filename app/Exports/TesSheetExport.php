<?php

namespace App\Exports;

use App\Models\tes;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class TesSheetExport implements FromArray, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $user;
    private $fileName;

    public function __construct($user, $fileName)
    {
        $this->user = $user;
        $this->fileName = $fileName;
    }

    public function array(): array
    {
        $data = [
            ['', '', '', ''],
            ['', '', '', ''],
            ['No', '', '', ''],
            ['Nama', $this->user->nama, '', ''],
            ['Umur', $this->user->umur, '', ''],
            ['Jenis Kelamin', $this->user->jenis_kelamin, '', ''],
            ['Institusi', $this->user->institusi, '', ''],
            ['Tanggal Tes', \Carbon\Carbon::parse($this->user->tes?->tanggal_tes)->format('d-m-Y'), '', ''],
            ['Keterangan', $this->user->tes?->keterangan ?? '', '', ''],
            ['', '', '', ''],

            // Header
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
        ];

        $allData = tes::with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        // foreach ($allData as $i => $item) {
        //     $fileName = \Carbon\Carbon::parse($item->created_at)->format('Ymd_His');
        //     $data[] = [
        //         $i + 1,
        //         $item->user?->nama,
        //         \Carbon\Carbon::parse($item->tanggal_tes)->format('d-m-Y'),
        //         '=HYPERLINK("#\'Sheet-' . $fileName . '\'!A1","' . $fileName . '")'
        //     ];
        // }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Header A1 - D1
                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', "Data Atlet");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 24],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(80);

                // Header kolom A3
                $sheet->setCellValue('A3', "No");
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B3:D3');

                // Header kolom A4
                $sheet->setCellValue('A4', "Nama");
                $sheet->getStyle('A4')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B4:D4');

                // Header kolom A5
                $sheet->setCellValue('A5', "Umur");
                $sheet->getStyle('A5')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B5:D5');

                // Header kolom A6
                $sheet->setCellValue('A6', "Jenis Kelamin");
                $sheet->getStyle('A6')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B6:D6');

                // Header kolom A7
                $sheet->setCellValue('A7', "Institusi");
                $sheet->getStyle('A7')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B7:D7');

                // Header kolom A8
                $sheet->setCellValue('A8', "Panjang Tungkai Kanan");
                $sheet->getStyle('A8')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B8:D8');

                // Header kolom A9
                $sheet->setCellValue('A9', "Panjang Tungkai Kiri");
                $sheet->getStyle('A9')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B9:D9');

                // Header kolom A10
                $sheet->setCellValue('A10', "Keterangan");
                $sheet->getStyle('A10')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B10:D10');



                // Header kolom A12 - A13
                $sheet->mergeCells('A12:A13');
                $sheet->setCellValue('A12', "Arah");
                $sheet->getStyle('A12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom B12 - B13
                $sheet->mergeCells('B12:B13');
                $sheet->setCellValue('B12', "Derajat");
                $sheet->getStyle('B12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom C12 - E12
                $sheet->mergeCells('C12:E12');
                $sheet->setCellValue('C12', "KANAN");
                $sheet->getStyle('C12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom C13
                $sheet->setCellValue('C13', "Reach 1 (cm)");
                $sheet->getStyle('C13')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom D13
                $sheet->setCellValue('D13', "Reach 2 (cm)");
                $sheet->getStyle('D13')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom E13
                $sheet->setCellValue('E13', "Reach 3 (cm)");
                $sheet->getStyle('E13')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom F12 - H12
                $sheet->mergeCells('F12:H12');
                $sheet->setCellValue('F12', "KIRI");
                $sheet->getStyle('F12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom F13
                $sheet->setCellValue('F13', "Reach 1 (cm)");
                $sheet->getStyle('F13')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom G13
                $sheet->setCellValue('G13', "Reach 2 (cm)");
                $sheet->getStyle('G13')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom H13
                $sheet->setCellValue('H13', "Reach 3 (cm)");
                $sheet->getStyle('H13')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom I12 - I13
                $sheet->mergeCells('I12:I13');
                $sheet->setCellValue('I12', "Nilai Terbaik KIRI (cm)");
                $sheet->getStyle('I12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom J12 - J13
                $sheet->mergeCells('J12:J13');
                $sheet->setCellValue('J12', "Nilai Terbaik KANAN (cm)");
                $sheet->getStyle('J12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom K12 - K13
                $sheet->mergeCells('K12:K13');
                $sheet->setCellValue('K12', "Panjang Tungkai KANAN (cm)");
                $sheet->getStyle('K12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom L12 - L13
                $sheet->mergeCells('L12:L13');
                $sheet->setCellValue('L12', "Panjang Tungkai KIRI (cm)");
                $sheet->getStyle('L12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom M12 - M13
                $sheet->mergeCells('M12:M13');
                $sheet->setCellValue('M12', "NilaI Normalisasi Kanan");
                $sheet->getStyle('M12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom N12 - N13
                $sheet->mergeCells('N12:N13');
                $sheet->setCellValue('N12', "Keterangan");
                $sheet->getStyle('N12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom O12 - O13
                $sheet->mergeCells('O12:O13');
                $sheet->setCellValue('O12', "Panjang Tungkai KIRI (cm)");
                $sheet->getStyle('O12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom P12 - P13
                $sheet->mergeCells('P12:P13');
                $sheet->setCellValue('P12', "Keterangan");
                $sheet->getStyle('P12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom Q12 - Q13
                $sheet->mergeCells('Q12:Q13');
                $sheet->setCellValue('Q12', "Nilai Composite Score (%) Kanan");
                $sheet->getStyle('Q12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom R12 - R13
                $sheet->mergeCells('R12:R13');
                $sheet->setCellValue('R12', "Nilai Composite Score (%) Kiri");
                $sheet->getStyle('R12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom S12 - U13
                $sheet->mergeCells('S12:U13');
                $sheet->setCellValue('S12', "Interpretasi Composite Score (% dari panjang tungkai)");
                $sheet->getStyle('S12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom V12 - V13
                $sheet->mergeCells('V12:V13');
                $sheet->setCellValue('V12', "Interpretasi Risiko Cedera (Atlet)");
                $sheet->getStyle('V12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom R12 - R13
                $sheet->mergeCells('W12:W13');
                $sheet->setCellValue('W12', "keterangan interpretasi risiko cedera");
                $sheet->getStyle('W12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                $lastRow = $sheet->getHighestRow();
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
                $sheet->getStyle("A12:W{$lastRow}")->applyFromArray($style);

                // Kolom A - W Lebarnya menyesuaikan konten
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);
                $sheet->getColumnDimension('L')->setAutoSize(true);
                $sheet->getColumnDimension('M')->setAutoSize(true);
                $sheet->getColumnDimension('N')->setAutoSize(true);
                $sheet->getColumnDimension('O')->setAutoSize(true);
                $sheet->getColumnDimension('P')->setAutoSize(true);
                $sheet->getColumnDimension('Q')->setAutoSize(true);
                $sheet->getColumnDimension('R')->setAutoSize(true);
                $sheet->getColumnDimension('S')->setAutoSize(true);
                // $sheet->getColumnDimension('T')->setAutoSize(true);
                // $sheet->getColumnDimension('U')->setAutoSize(true);
                $sheet->getColumnDimension('V')->setAutoSize(true);
                $sheet->getColumnDimension('W')->setAutoSize(true);
            },
        ];
    }

    public function title(): string
    {
        return 'Sheet-' . $this->fileName;
    }
}
