<?php

namespace App\Exports;

use App\Models\Pembayaran;
use App\Models\ViewPembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ViewPembayaran::all();
    }

    public function headings(): array
    {
        return [
            'ID Pembayaran', 'ID Petugas', 'Nama Petugas','Level','Email Petugas','NISN','NIS','Nama Siswa','ID Kelas','Nama Kelas','Kompetensi Keahlian','Alamat','No Telepon','Tanggal Bayar','Bulan Dibayar','Tahun Dibayar','ID Spp','Tahun','Nominal','Jumlah Bayar','Created AT','Updated AT',
        ];
    }
}
