<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurnal;
use App\Models\JurnalDetail;
use PDF;

class CetakController extends Controller
{
    public function cetak_laporan($siswaid, $ta, $bulan)
    {
        // echo "Test";
        $siswa = Siswa::where('id', $siswaid)->first();
        $jurnal_all = Jurnal::join('jurnal_details', 'jurnals.id', '=', 'jurnal_details.jurnal_id')->where('jurnals.tahun_ajaran_id', $ta)->where('jurnal_details.siswa_id', $siswaid)->whereMonth('tanggal', '=', $bulan)->get();
        $jurnal = Jurnal::join('jurnal_details', 'jurnals.id', '=', 'jurnal_details.jurnal_id')->where('jurnals.tahun_ajaran_id', $ta)->where('jurnal_details.siswa_id', $siswaid)->whereMonth('tanggal', '=', $bulan)->first();
        if ($jurnal_all) {
            $pdf = PDF::loadView('cetak.laporan_pembelajaran', ['jurnal' => $jurnal, 'jurnal_all' => $jurnal_all, 'bulan' => $bulan, 'siswa' => $siswa]);
            $pdf->setPaper('A4', 'portrait');
            $namadokumen = $siswa->nama . '-laporan-pembelajaran-pkl-' . $bulan . '.pdf';
            return $pdf->download($namadokumen);
        } else {
            return redirect()->route('laporan')->with('warning', 'Data jurnal tidak ditemukan!');
        }
    }
}
