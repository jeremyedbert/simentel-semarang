<?php

namespace App\Exports;

use App\Http\Controllers\ExcelController;
use App\Models\Tower;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TowerExport implements FromQuery, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct($startDate, $endDate, $tipe, $id)
    {
        $this->tipe = $tipe;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->id = $id;
    }

    /** This is the styling thingy. 
     * So unnecessary but have to make the user experience better.*/

    /** HEADING: ini bagian untuk judul dan penamaan kolom.*/
    public function headings(): array
    {
        if ($this->tipe == 5) {
            $menara = 'Semua Menara';
        } else if ($this->tipe == 1) {
            $menara = 'Menara Makro';
        } else {
            $menara = 'Menara Mikro';
        }

        return [
            [$menara . ' Dari ' . $this->startDate . ' sampai ' . $this->endDate],
            [],
            [
                'ID Menara',
                'Kecamatan',
                'Tipe Menara',
                'Latitude',
                'Longitude',
                'Pemilik',
                'Penyewa',
                'Tinggi (m)',
                'Acc Date',
            ]
        ];
    }

    /** COLUMN WIDTHS: ini adalah lebar dari kolom, bisa diatur satu per satu.*/
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 15,
            'C' => 10,
            'D' => 10,
            'E' => 15,
            'F' => 25,
            'G' => 15,
            'H' => 10,
            'I' => 15,
        ];
    }

    /** STYLES: ini adalah font style dari tiap kolom dan baris. 
     * Bisa diatur juga untuk style tertentu*/
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            3 => ['font' => ['bold' => true]],
            'A' => ['font' => ['size' => 12]],
            'B' => ['font' => ['size' => 12]],
            'C' => ['font' => ['size' => 12]],
            'D' => ['font' => ['size' => 12]],
            'E' => ['font' => ['size' => 12]],
            'F' => ['font' => ['size' => 12]],
            'G' => ['font' => ['size' => 12]],
            'H' => ['font' => ['size' => 12]],
            'I' => ['font' => ['size' => 12]],
            'A1' => ['font' => [
                'bold' => true,
                'italic' => true,
                'size' => 20
            ]],
        ];
    }

    /** EVENTS: ini adalah bentuk dari suatu event, 
     * salah satu yang dibuat adalah merge cell.*/
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:I1')->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },

        ];
    }

    /** QUERY: ini adalah pemanggilan data berdasarkan input 
     * yang sudah dipassing dari ExcelController.php*/
    public function query()
    {
        if ($this->tipe == 5) {
            return Tower::query()
                // Filter kecamatan
                ->select(
                    'idMenara',
                    'kecamatan_id',
                    'tipe_menara_id',
                    'latitude',
                    'longitude',
                    'pemilik',
                    'penyewa',
                    'tinggi',
                    'acc_date'
                )
                ->whereIn('id', $this->id)
                // Filter tanggal
                ->whereBetween('acc_date', [$this->startDate, $this->endDate])
                // Filter tipe menara
                ->where(function ($query) {
                    $query->where('tipe_menara_id', 1);
                    $query->orWhere('tipe_menara_id', 2);
                })
                ->whereNotNull('acc_date');
        }

        return Tower::query()
            ->select(
                'idMenara',
                'kecamatan_id',
                'tipe_menara_id',
                'latitude',
                'longitude',
                'pemilik',
                'penyewa',
                'tinggi',
                'acc_date',
            )
            // Filter kecamatan
            ->whereIn('id', $this->id)
            // Filter tipe menara
            ->where('tipe_menara_id', $this->tipe)
            // Filter tanggal
            ->whereBetween('acc_date', [$this->startDate, $this->endDate])
            ->whereNotNull('acc_date');
    }
}
