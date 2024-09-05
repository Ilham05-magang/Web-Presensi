<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class GajiKaryawanExport implements FromArray, WithStyles, WithColumnWidths
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $karyawan = Karyawan::findOrFail($this->id);

        $valueSheet = [];
        $rowIndex = 4; // Memulai data dari baris 4

        foreach ($karyawan->gajiKaryawan as $gajiKaryawan) {
            $valueSheet[$rowIndex++] = [null, null, null];
            $valueSheet[$rowIndex++] = [null, null, null];
            $valueSheet[$rowIndex++] = [null, null, null];
            $valueSheet[$rowIndex++] = [null, null, null];
            // Header Row for Shift and Method
            $valueSheet[$rowIndex++] = [null, $gajiKaryawan->shift, $gajiKaryawan->shift_total];
            $valueSheet[$rowIndex++] = [null, "Nama", $karyawan->nama];

            // Add the "Metode Pembayaran" and "Transfer" data
            $valueSheet[$rowIndex++] = [null, "Metode Pembayaran", $gajiKaryawan->method];

            $valueSheet[$rowIndex++] = [null, null, null];

            // Add the Honorarium data
            foreach ($gajiKaryawan->gajiHeader as $gajiHeader) {
                if($gajiHeader->value == 0){
                    $valueSheet[$rowIndex++] = [null, $gajiHeader->name, ".$gajiHeader->value" ];
                }else{
                    $valueSheet[$rowIndex++] = [null, $gajiHeader->name, $gajiHeader->value ];
                }
            }

            // Empty Row for spacing
            $valueSheet[$rowIndex++] = [null, null, null];

            foreach ($gajiKaryawan->gajiDetail as $gajiDetail) {
                if ($gajiDetail->multiply === null && $gajiDetail->value === null) {
                    $valueSheet[$rowIndex++] = [null, null, null];
                    $formattedValueTotal = number_format($gajiDetail->value_total, 2, ',', '.');
                    $valueSheet[$rowIndex++] = [null, $gajiDetail->name, "Rp. $formattedValueTotal"];
                } else {
                    $formattedValue = number_format($gajiDetail->value, 2, ',', '.');
                    $formattedValueTotal = number_format($gajiDetail->value_total, 2, ',', '.');

                    if ($gajiDetail->multiply == 0) {
                        $valueSheet[$rowIndex++] = [null, "$gajiDetail->name (0 x Rp. $formattedValue)", "Rp. $formattedValueTotal"];
                    } else {
                        $valueSheet[$rowIndex++] = [null, "$gajiDetail->name ({$gajiDetail->multiply} x Rp. $formattedValue)", "Rp. $formattedValueTotal"];
                    }
                }
            }

            $valueSheet[$rowIndex++] = [null, null, null];
            // Add the Note
            $valueSheet[$rowIndex++] = [null, "Note", $gajiKaryawan->note];

            $valueSheet[$rowIndex++] = [null, null, null];
            $valueSheet[$rowIndex++] = [null, null, null];
            $valueSheet[$rowIndex++] = [null, null, null];
        }

        return $valueSheet;
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $data = $this->array();
        $rowIndex = 5; // Start from row 4
        $skipBorderRowsAfterNote = 3; // Number of rows to skip after "Note"
        $borderSkippedRows = 0; // Track rows after "Note"

        foreach ($data as $row) {
            // Convert row index to Excel's row index (Excel is 1-based, so we start from 4)
            $excelRowIndex = $rowIndex;

            // Define the range for the current row
            $cellRange = 'B' . $excelRowIndex . ':C' . $excelRowIndex;

            // If "Note" is encountered, start counting rows for which borders should be skipped
            if ($row[1] === 'Note') {
                $borderSkippedRows = 1;
            } elseif ($borderSkippedRows > 0 && $borderSkippedRows <= $skipBorderRowsAfterNote) {
                // Increment skipped rows counter
                $borderSkippedRows++;
            } elseif ($borderSkippedRows > $skipBorderRowsAfterNote) {
                // Once 5 rows are skipped after "Note", reset counter and apply borders again
                $borderSkippedRows = 0;
            }

            // Apply borders only if we're not in the skipped rows after "Note"
            if ($borderSkippedRows === 0) {
                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                ]);
            }

            // Apply right alignment to all cells in column C
            $sheet->getStyle('C' . $excelRowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            $rowIndex++;
        }

        return []; // Return styles if needed
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'B' => 50,
            'C' => 30,
        ];
    }
}
