<?php

namespace App\Http\Livewire;

use App\Models\Dudi;
use App\Models\Jenis_kegiatan;
use App\Models\Siswa_pkl;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Tahun_ajaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddJurnal extends Component
{
    use LivewireAlert;

    public $showSiswa = false;
    public $dudi, $user, $jeniskeg, $siswa;
    public $siswaid, $kehadiran, $keterangan = [];

    public function render()
    {
        $ta = Tahun_ajaran::where('aktif', 1)->first();
        $jeniskeg = Jenis_kegiatan::all();
        if (auth()->user()->hasRole(['admin', 'waka'])) {
            $dudi = Dudi::all();
            $user = User::all();
        } else {
            $dudi_pkl = Siswa_pkl::where('user_id', Auth::user()->id)->groupBy('dudi_id')->pluck('dudi_id');
            $dudi = Dudi::whereIn('id', $dudi_pkl)->get();
            $user = User::where('id', auth()->user()->id)->first();
        }
        return view('livewire.add-jurnal', [
            'ta' => $ta,
            'data_dudi' => $dudi,
            'users' => $user,
            'jk' => $jeniskeg,
        ])->extends('layouts.app');
    }

    public function updatedUser($id)
    {
        $dudi_pkl = Siswa_pkl::where('user_id', $id)->groupBy('dudi_id')->pluck('dudi_id');
        $this->dudi = Dudi::whereIn('id', $dudi_pkl)->get();
    }

    public function updatedDudi($id)
    {
        $this->siswa = Siswa_pkl::where('dudi_id', $id)->get();
        $this->showSiswa = true;
    }
}
