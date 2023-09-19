<?php

namespace App\Http\Livewire;

use App\Models\Kelas;
use App\Models\Tahun_ajaran;
use Livewire\Component;

class Siswapkl extends Component
{
    public function render()
    {
        $ta = Tahun_ajaran::where('aktif', 1)->first();
        return view('livewire.siswapkl', [
            'ta' => $ta,
        ])->extends('layouts.app');
    }
}
