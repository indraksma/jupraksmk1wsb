<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Dudi;
use App\Models\Siswa_pkl;
use Livewire\Component;

class Laporan extends Component
{
    public $user_id, $guru, $dudi, $laporan_type, $jenis_laporan, $dudi_id, $bulan, $siswa;
    public $showSiswa = false;
    public function render()
    {
        $user = User::all();
        return view('livewire.laporan', [
            'nama_guru' => $user,
        ])->extends('layouts.app');
    }

    public function updatedJenisLaporan($type)
    {
        $this->reset(['laporan_type', 'dudi', 'user_id', 'bulan', 'siswa']);
        $this->showSiswa = false;
        $this->laporan_type = $type;
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
}
