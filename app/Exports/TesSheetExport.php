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
    private $allData;

    public function __construct($user, $fileName)
    {
        $this->user = $user;
        $this->fileName = $fileName;

        $this->allData = tes::with('user', 'normalisasi', 'data_kiri', 'data_kanan', 'composite_score')
            ->where('user_id', $this->user->id)
            ->first();
    }

    public function array(): array
    {
        $data = [
            ['', '', '', ''],
            ['', '', '', ''],
            ['File Name', '', '', ''],
            ['Nama', $this->allData->user->nama, '', ''],
            ['Umur', $this->allData->user->umur, '', ''],
            ['Jenis Kelamin', $this->user->jk == 'L' ? 'Pria' : 'Wanita', '', ''],
            ['Institusi', $this->allData->institusi, '', ''],
            ['Tanggal Tes', \Carbon\Carbon::parse($this->allData->tanggal_tes)->format('d-m-Y'), '', ''],
            ['Keterangan', $this->allData->keterangan ?? '-', '', ''],
            ['', '', '', ''],

            // Header
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],

            // Data
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
        ];

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
                $sheet->setCellValue('A3', "File Name");
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                $sheet->mergeCells('B3:D3');
                $sheet->setCellValue('B3', $event->sheet->getTitle());
                $sheet->getStyle('B3')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => [
                        'horizontal' => 'left',
                        'vertical' => 'center'
                    ],
                ]);

                // Header kolom A4
                $sheet->setCellValue('A4', "Nama");
                $sheet->getStyle('A4')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B4:D4');
                $sheet->getStyle('B4')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                // Header kolom A5
                $sheet->setCellValue('A5', "Umur");
                $sheet->getStyle('A5')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B5:D5');
                $sheet->getStyle('B5')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                // Header kolom A6
                $sheet->setCellValue('A6', "Jenis Kelamin");
                $sheet->getStyle('A6')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B6:D6');
                $sheet->getStyle('B5')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                // Header kolom A7
                $sheet->setCellValue('A7', "Institusi");
                $sheet->getStyle('A7')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B7:D7');
                $sheet->getStyle('B7')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                // Header kolom A8
                $sheet->getStyle('A8')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B8:D8');
                $sheet->getStyle('B8')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                // Header kolom A9
                $sheet->getStyle('A9')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);
                $sheet->mergeCells('B9:D9');
                $sheet->getStyle('B9')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                $sheet->getRowDimension(11)->setRowHeight(45);
                $sheet->getRowDimension(12)->setRowHeight(45);

                // ========================================================================================= //
                // ===============================   HEADER COLOM   ======================================== //
                // ========================================================================================= //

                // Header kolom A11 - A12
                $sheet->mergeCells('A11:A12');
                $sheet->setCellValue('A11', "Arah");
                $sheet->getStyle('A11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom B11 - B12
                $sheet->mergeCells('B11:B12');
                $sheet->setCellValue('B11', "Derajat");
                $sheet->getStyle('B11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom C11 - E11
                $sheet->mergeCells('C11:E11');
                $sheet->setCellValue('C11', "KANAN");
                $sheet->getStyle('C11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom C12
                $sheet->setCellValue('C12', "Reach 1 (cm)");
                $sheet->getStyle('C12')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom D12
                $sheet->setCellValue('D12', "Reach 2 (cm)");
                $sheet->getStyle('D12')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom E12
                $sheet->setCellValue('E12', "Reach 3 (cm)");
                $sheet->getStyle('E12')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom F11 - H11
                $sheet->mergeCells('F11:H11');
                $sheet->setCellValue('F11', "KIRI");
                $sheet->getStyle('F11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom F12
                $sheet->setCellValue('F12', "Reach 1 (cm)");
                $sheet->getStyle('F12')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom G12
                $sheet->setCellValue('G12', "Reach 2 (cm)");
                $sheet->getStyle('G12')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom H12
                $sheet->setCellValue('H12', "Reach 3 (cm)");
                $sheet->getStyle('H12')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom I11 - I12
                $sheet->mergeCells('I11:I12');
                $sheet->setCellValue('I11', "Nilai Terbaik\nKanan (cm)");
                $sheet->getStyle('I11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom J11 - J12
                $sheet->mergeCells('J11:J12');
                $sheet->setCellValue('J11', "Nilai Terbaik\nKiri (cm)");
                $sheet->getStyle('J11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom K11 - K12
                $sheet->mergeCells('K11:K12');
                $sheet->setCellValue('K11', "Panjang\nTungkai\nKanan (cm)");
                $sheet->getStyle('K11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom L11 - L12
                $sheet->mergeCells('L11:L12');
                $sheet->setCellValue('L11', "Panjang\nTungkai\nKiri (cm)");
                $sheet->getStyle('L11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom M11 - M12
                $sheet->mergeCells('M11:M12');
                $sheet->setCellValue('M11', "Nilai Normalisasi\nKanan (%)");
                $sheet->getStyle('M11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom N12 - N13
                $sheet->mergeCells('N11:N12');
                $sheet->setCellValue('N11', "Keterangan");
                $sheet->getStyle('N11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom O11 - O12
                $sheet->mergeCells('O11:O12');
                $sheet->setCellValue('O11', "Nilai Normalisasi\nKiri (%)");
                $sheet->getStyle('O11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom P11 - P12
                $sheet->mergeCells('P11:P12');
                $sheet->setCellValue('P11', "Keterangan");
                $sheet->getStyle('P11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Header kolom Q11 - Q12
                $sheet->mergeCells('Q11:Q12');
                $sheet->setCellValue('Q11', "Nilai Composite\n Score (%)\n Kanan");
                $sheet->getStyle('Q11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom R11 - R12
                $sheet->mergeCells('R11:R12');
                $sheet->setCellValue('R11', "Nilai Composite\n Score (%)\n Kiri");
                $sheet->getStyle('R11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom S11 - U12
                $sheet->mergeCells('S11:U12');
                $sheet->setCellValue('S11', "Interpretasi Composite Score (% dari panjang tungkai)");
                $sheet->getStyle('S11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom V11 - V12
                $sheet->mergeCells('V11:V12');
                $sheet->setCellValue('V11', "Interpretasi\n Risiko Cedera\n (Atlet)");
                $sheet->getStyle('V11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Header kolom R11 - R12
                $sheet->mergeCells('W11:W12');
                $sheet->setCellValue('W11', "keterangan interpretasi risiko\n cedera");
                $sheet->getStyle('W11')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);


                // ========================================================================================= //
                // ===============================   DATA COLOM   ======================================== //
                // ========================================================================================= //
                $arah = ['Anterior', 'Anteromedial', 'Medial', 'Posteromedial', 'Posterior', 'Posterolateral', 'Lateral', 'Anterolateral'];

                $row = 13;
                foreach ($arah as $value) {
                    $sheet->setCellValue('A' . $row, $value);
                    $sheet->getStyle('A' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'left',
                            'vertical' => 'center'
                        ],
                    ]);

                    $row++;
                }

                $derajat = [0, 45, 90, 135, 180, 225, 270, 315];
                $row = 13;
                foreach ($derajat as $value) {
                    $sheet->setCellValue('B' . $row, $value);
                    $sheet->getStyle('B' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center',
                        ],
                    ]);

                    $row++;
                }

                // Kolom Reach Kanan dan Kiri
                $colomKanan = [
                    'a'  => ['C13', 'D13', 'E13'],
                    'am' => ['C14', 'D14', 'E14'],
                    'm'  => ['C15', 'D15', 'E15'],
                    'pm' => ['C16', 'D16', 'E16'],
                    'p'  => ['C17', 'D17', 'E17'],
                    'pl' => ['C18', 'D18', 'E18'],
                    'l'  => ['C19', 'D19', 'E19'],
                    'al' => ['C20', 'D20', 'E20'],
                ];

                $colomKiri = [
                    'a'  => ['F13', 'G13', 'H13'],
                    'am' => ['F14', 'G14', 'H14'],
                    'm'  => ['F15', 'G15', 'H15'],
                    'pm' => ['F16', 'G16', 'H16'],
                    'p'  => ['F17', 'G17', 'H17'],
                    'pl' => ['F18', 'G18', 'H18'],
                    'l'  => ['F19', 'G19', 'H19'],
                    'al' => ['F20', 'G20', 'H20'],
                ];

                // Reach Kanan & Kiri
                $dataKanan = $this->allData->data_kanan;
                foreach ($colomKanan as $arah => $cells) {
                    foreach ($cells as $index => $cell) {
                        $i = $index + 1;
                        $sheet->setCellValue($cell, $dataKanan->{$arah . $i});
                        $sheet->getStyle($cell)->applyFromArray([
                            'font' => ['bold' => false, 'size' => 12],
                            'alignment' => [
                                'horizontal' => 'center',
                                'vertical' => 'center',
                            ],
                        ]);
                    }
                }

                $dataKiri = $this->allData->data_kiri;
                foreach ($colomKiri as $arah => $cells) {
                    foreach ($cells as $index => $cell) {
                        $i = $index + 1;
                        $sheet->setCellValue($cell, $dataKiri->{$arah . $i});
                        $sheet->getStyle($cell)->applyFromArray([
                            'font' => ['bold' => false, 'size' => 12],
                            'alignment' => [
                                'horizontal' => 'center',
                                'vertical' => 'center',
                            ],
                        ]);
                    }
                }

                // Nilai terbaik Kanan & Kiri
                $ruleKanan = ['a_ka', 'am_ka', 'm_ka', 'pm_ka', 'p_ka', 'pl_ka', 'l_ka', 'al_ka'];
                $ruleKiri = ['a_ki', 'am_ki', 'm_ki', 'pm_ki', 'p_ki', 'pl_ki', 'l_ki', 'al_ki'];

                $row = 13;
                $terbaikKanan = $this->allData->composite_score;
                foreach ($ruleKanan as $value) {
                    $sheet->setCellValue('I' . $row, $terbaikKanan->{$value});
                    $sheet->getStyle('I' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center',
                        ],
                    ]);
                    $row++;
                }

                $row = 13;
                $terbaikKiri = $this->allData->composite_score;
                foreach ($ruleKiri as $value) {
                    $sheet->setCellValue('J' . $row, $terbaikKiri->{$value});
                    $sheet->getStyle('I' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center',
                        ],
                    ]);
                    $row++;
                }

                // Normalisasi Kanan & Kiri
                $row = 13;
                $normalisasiKanan = $this->allData->normalisasi;
                foreach ($ruleKanan as $value) {
                    $sheet->setCellValue('M' . $row, $normalisasiKanan->{$value});
                    $sheet->getStyle('M' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center',
                        ],
                    ]);
                    $row++;
                }

                $row = 13;
                $normalisasiKiri = $this->allData->normalisasi;
                foreach ($ruleKiri as $value) {
                    $sheet->setCellValue('O' . $row, $normalisasiKiri->{$value});
                    $sheet->getStyle('O' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center',
                        ],
                    ]);
                    $row++;
                }

                // Panjang tungkai Kanan & Kiri
                $sheet->mergeCells('K13:K20');
                $sheet->setCellValue('K13', $this->allData->tungkai_kanan);
                $sheet->getStyle('K13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                $sheet->mergeCells('L13:L20');
                $sheet->setCellValue('L13', $this->allData->tungkai_kiri);
                $sheet->getStyle('L13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);


                // Resiko Stabilitas
                $sheet->mergeCells('N13:N20');
                $sheet->setCellValue('N13', "<80 : risiko instabilitas\n80-89 : cukup\n90-100 : baik\n>100 : sangat baik");
                $sheet->getStyle('N13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                $sheet->mergeCells('P13:P20');
                $sheet->setCellValue('P13', "<80 : risiko instabilitas\n80-89 : cukup\n90-100 : baik\n>100 : sangat baik");
                $sheet->getStyle('P13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // CSR & CSL
                $sheet->mergeCells('Q13:Q20');
                $sheet->setCellValue('Q13', $this->allData->composite_score->csr);
                $sheet->getStyle('Q13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                $sheet->mergeCells('R13:R20');
                $sheet->setCellValue('R13', $this->allData->composite_score->csl);
                $sheet->getStyle('R13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // Interprestasi Composite Score
                $interpretasi = [
                    0 => ['≥ 95%', 'Sangat Baik (excellent dynamic balance)'],
                    1 => ['90 - 94%', 'Baik'],
                    2 => ['85 - 89%', 'Cukup / Fair'],
                    3 => ['80 - 84%', 'Kurang'],
                    4 => ['< 80%', 'Defisit signifikan'],
                ];

                $row = 13;
                foreach ($interpretasi as $key => $value) {
                    $sheet->setCellValue('T' . $row, $value[0]);
                    $sheet->setCellValue('U' . $row, $value[1]);
                    $sheet->getStyle('T' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'left',
                            'vertical' => 'center',
                        ],
                    ]);
                    $sheet->getStyle('U' . $row)->applyFromArray([
                        'font' => ['bold' => false, 'size' => 12],
                        'alignment' => [
                            'horizontal' => 'left',
                            'vertical' => 'center',
                        ],
                    ]);
                    $row++;
                }

                $csr = $this->allData->composite_score->csr;
                $csl = $this->allData->composite_score->csl;
                $ratarata = ($csr + $csl) / 2;

                $hasilView = "";
                if ($ratarata >= 95) {
                    $hasilView = "Sangat Baik\n(excellent dynamic balance)";
                } elseif ($ratarata >= 90) {
                    $hasilView = "Baik";
                } elseif ($ratarata >= 85) {
                    $hasilView = "Cukup";
                } elseif ($ratarata >= 80) {
                    $hasilView = "Kurang";
                } else {
                    $hasilView = "Defisit signifikan";
                }

                $sheet->mergeCells('S13:S20');
                $sheet->setCellValue('S13', $hasilView);
                $sheet->getStyle('S13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                $nilai = (float) str_replace(',', '.', $this->allData->selisih_anterior);
                $sheet->mergeCells('V13:V20');
                $sheet->setCellValue('V13', $nilai);
                $sheet->getStyle('V13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'numberFormat' => ['formatCode' => '0.00']
                ]);

                $selisih = $this->allData->selisih_anterior;
                $hasilSelisih = "";
                if ($selisih > 4) {
                    $hasilSelisih = "Perbedaan kanan-kiri > 4-5%  risiko cedera meningkat";
                } else {
                    $hasilSelisih = "Risiko cedera rendah";
                }

                $sheet->mergeCells('W13:W20');
                $sheet->setCellValue('W13', $hasilSelisih);
                $sheet->getStyle('W13')->applyFromArray([
                    'font' => ['bold' => false, 'size' => 12],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                ]);

                // ========================================================================================= //
                // =======================   Pengaturan ALL COLOM   ======================================== //
                // ========================================================================================= //
                // Mengatur Border
                $lastRow = $sheet->getHighestRow();
                $style = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle("A11:W{$lastRow}")->applyFromArray($style);

                // Kolom A - W Lebarnya menyesuaikan konten
                foreach (range('A', 'W') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }

    public function title(): string
    {
        return 'Sheet-' . $this->fileName;
    }
}
