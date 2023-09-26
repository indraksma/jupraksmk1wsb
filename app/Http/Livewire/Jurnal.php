<?php

namespace App\Http\Livewire;

use App\Models\Tahun_ajaran;
use Livewire\Component;

class Jurnal extends Component
{
    public function render()
    {
        $ta = Tahun_ajaran::where('aktif', 1)->pluck('id');
        return view('livewire.jurnal', [
            ''
        ])->extends('layouts.app');
    }
}
