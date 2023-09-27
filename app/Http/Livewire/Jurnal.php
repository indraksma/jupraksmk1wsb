<?php

namespace App\Http\Livewire;

use App\Models\Siswa_pkl;
use App\Models\Tahun_ajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Jurnal extends Component
{
    public function render()
    {
        $ta_id = Tahun_ajaran::where('aktif', 1)->pluck('id');
        $ta = Tahun_ajaran::where('aktif', 1)->first();
        $user_id = Auth::user()->id;
        $cek_siswa = Siswa_pkl::where('user_id', $user_id)->where('tahun_ajaran_id', $ta_id)->count();
        return view('livewire.jurnal', [
            'cek_siswa' => $cek_siswa,
            'ta' => $ta,
        ])->extends('layouts.app');
    }
}
