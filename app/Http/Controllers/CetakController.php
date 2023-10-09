<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurnal;
use PDF;

class CetakController extends Controller
{
    public function cetak_laporan($siswaid, $bulan)
    {
        // echo "Test";
        $nama_siswa = Siswa::where('id', $siswaid)->pluck('nama');
        $jurnal_all = Jurnal::join('jurnal_details', 'jurnals.id', '=', 'jurnal_details.jurnal_id')->where('jurnal_details.siswa_id', $siswaid)->whereMonth('tanggal', '=', $bulan)->get();
        $jurnal = Jurnal::join('jurnal_details', 'jurnals.id', '=', 'jurnal_details.jurnal_id')->where('jurnal_details.siswa_id', $siswaid)->whereMonth('tanggal', '=', $bulan)->first();
        $pdf = PDF::loadView('cetak.laporan_pembelajaran', ['jurnal' => $jurnal, 'jurnal_all' => $jurnal_all, 'bulan' => $bulan]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
