<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Siswa extends Component
{
    public $iteration = 0;
    public function render()
    {
        return view('livewire.siswa', [
            'iteration' => $this->iteration,
        ])->extends('layouts.app');
    }

    public function edit($id)
    {
        $this->emit('show-modal');
    }
}
