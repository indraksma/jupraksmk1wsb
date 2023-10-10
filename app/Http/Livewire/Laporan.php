<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Dudi;
use App\Models\Jurnal;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa_pkl;
use App\Models\Tahun_ajaran;
use PDF;
use Livewire\Component;

class Laporan extends Component
{
    public $user_id, $guru, $dudi, $laporan_type, $jenis_laporan, $dudi_id, $bulan, $siswa, $ta_id, $list_jurusan, $jurusan_id, $kelas_id, $list_kelas;
    public $showSiswa = false;
    public $showPrintBtn = false;

    public function mount()
    {
        $tahun_ajaran = Tahun_ajaran::where('aktif', 1)->first();
        $this->ta_id = $tahun_ajaran->id;
    }

    public function render()
    {
        $tahun_ajaran = Tahun_ajaran::all();
        $user = User::all();
        return view('livewire.laporan', [
            'tahun_ajaran' => $tahun_ajaran,
            'nama_guru' => $user,
        ])->extends('layouts.app');
    }

    public function updatedJenisLaporan($type)
    {
        $this->reset(['laporan_type', 'dudi', 'dudi_id', 'user_id', 'bulan', 'siswa', 'list_jurusan', 'list_kelas', 'jurusan_id', 'kelas_id']);
        $this->showSiswa = false;
        $this->showPrintBtn = false;
        $this->laporan_type = $type;
        if ($type == 1) {
            $this->jurusan_id = '';
            $this->kelas_id = '';
            $this->list_jurusan = Jurusan::all();
        } else {
            $this->user_id = '';
            $this->dudi_id = '';
        }
    }

    public function updatedJurusanId($id)
    {
        $this->reset(['kelas_id', 'list_kelas']);
        $this->showPrintBtn = false;
        $this->list_kelas = Kelas::where('jurusan_id', $id)->where('tahun_ajaran_id', $this->ta_id)->get();
    }

    public function updatedKelasId()
    {
        $this->showPrintBtn = true;
    }

    public function updatedUserId($id)
    {
        $this->reset(['dudi_id', 'bulan', 'siswa']);
        $this->showSiswa = false;
        $dudi_pkl = Siswa_pkl::where('user_id', $id)->groupBy('dudi_id')->pluck('dudi_id');
        $dudi_list = Dudi::whereIn('id', $dudi_pkl)->get();
        $this->dudi = $dudi_list;
    }

    public function updatedDudiId()
    {
        $this->reset(['bulan', 'siswa']);
        $this->showSiswa = false;
    }

    public function updatedBulan($bulan)
    {
        $this->showSiswa = true;
        $siswa = Siswa_pkl::where('user_id', $this->user_id)->where('dudi_id', $this->dudi_id)->get();
        $this->siswa = $siswa;
    }

    public function cetakLaporan1()
    {
        return redirect()->route('cetak.laporan2', [$siswaid, $this->ta_id, $this->bulan]);
    }

    public function cetakLaporan2($type, $siswaid)
    {
        return redirect()->route('cetak.laporan2', [$siswaid, $this->ta_id, $this->bulan]);
    }
}
