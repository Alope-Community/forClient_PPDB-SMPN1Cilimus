<?php

namespace App\Exports;

use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PendaftarExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return Pendaftaran::latest()->get();
    }

    // 🔹 HEADER
    public function headings(): array
    {
        return [
            'Tanggal Daftar',
            'Nama',
            'NISN',
            'Asal Sekolah',
            'Jalur',
            'Jenis Kelamin',
            'Tempat, Tanggal Lahir',
            'Tinggi Badan',
            'Berat Badan',
            'Lingkar Kepala',
            'Anak Ke',
            'Jumlah Saudara',
            'Memiliki KIP',
            'Agama',
            'Alamat',
            'No HP',
            'Email',
            'Nilai B. Indo',
            'Nilai Matematika',
            'Nilai IPA',
            'Jumlah Nilai',
            'Nama Ayah',
            'Nama Ibu',
        ];
    }

    // 🔹 FORMAT DATA
    public function map($item): array
    {
        return [
            $item->created_at->format('d-m-Y'),
            $item->nama_lengkap,
            $item->nisn,
            $item->asal_sd_mi,
            ucwords(str_replace('_', ' ', $item->jalur_pendaftaran)),
            $item->jenis_kelamin,
            $item->tempat_lahir . ', ' . $item->tanggal_lahir,
            $item->tinggi_badan,
            $item->berat_badan,
            $item->lingkar_kepala,
            $item->anak_ke,
            $item->jumlah_saudara,
            $item->memiliki_kip,
            $item->agama,
            $item->alamat_lengkap,
            $item->no_hp_siswa,
            $item->email_siswa,
            $item->nilai_bindo,
            $item->nilai_matematika,
            $item->nilai_ipa,
            $item->jumlah_nilai,
            $item->nama_ayah,
            $item->nama_ibu,
        ];
    }

    // 🔹 STYLING
    public function styles(Worksheet $sheet)
    {
        // 🎨 HEADER STYLE (A1 - W1)
        $sheet->getStyle('A1:W1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // hijau
            ],
        ]);

        // ❄️ Freeze header
        $sheet->freezePane('A2');

        // 📏 BORDER SELURUH TABEL
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:W' . $lastRow)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        return [];
    }
}