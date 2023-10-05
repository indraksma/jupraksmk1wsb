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
    public $dudi, $user, $jeniskeg, $siswa, $dudi_list, $link_dokumentasi;
    public $siswaid = [];
    public $kehadiran = [];
    public $keterangan = [];

    private $cekform = true;

    protected $rules = [
        'dudi' => 'required',
        'siswaid.*' => 'required',
        'kehadiran.*' => 'required',
        'keterangan.*' => 'required',
        'jeniskeg' => 'required',
        'link_dokumentasi' => 'required',
        'user' => 'required',
    ];

    public function render()
    {
        $ta = Tahun_ajaran::where('aktif', 1)->first();
        $jeniskeg = Jenis_kegiatan::all();
        if (Auth::user()->hasRole(['admin', 'waka'])) {
            $dudi_list = Dudi::all();
            $user = User::all();
        } else {
            $dudi_pkl = Siswa_pkl::where('user_id', Auth::user()->id)->groupBy('dudi_id')->pluck('dudi_id');
            $dudi_list = Dudi::whereIn('id', $dudi_pkl)->get();
            $this->dudi_list = $dudi_list;
            $user = User::where('id', auth()->user()->id)->first();
            $this->user = $user->id;
        }
        return view('livewire.add-jurnal', [
            'ta' => $ta,
            'data_dudi' => $dudi_list,
            'users' => $user,
            'jk' => $jeniskeg,
        ])->extends('layouts.app');
    }

    public function updatedUser($id)
    {
        $this->reset('dudi');
        $this->dudi = '';
        $dudi_pkl = Siswa_pkl::where('user_id', $id)->groupBy('dudi_id')->pluck('dudi_id');
        $this->dudi_list = Dudi::whereIn('id', $dudi_pkl)->get();
        $this->cekform();
    }

    public function updatedDudi()
    {
        $this->reset('siswaid');
        $siswapkl = Siswa_pkl::where('dudi_id', $this->dudi)->get();
        if ($siswapkl) {
            foreach ($siswapkl as $key => $s) {
                $this->siswaid[$key] = $s->siswa->id;
            }
        }
        $this->siswa = $siswapkl;
        $this->cekform();
    }

    public function UpdatedJeniskeg()
    {
        $this->cekform();
    }

    public function updatedLinkDokumentasi()
    {
        $this->cekform();
    }

    private function cekform()
    {
        if ($this->link_dokumentasi == "") {
            $this->cekform = false;
        }
        if ($this->dudi == "") {
            $this->cekform = false;
        }
        if ($this->user == "") {
            $this->cekform = false;
        }
        if ($this->jeniskeg == "") {
            $this->cekform = false;
        }
        if ($this->cekform) {
            $this->showSiswa = true;
        } else {
            $this->showSiswa = false;
        }
    }

    public function store()
    {
        dd($this->siswaid);
    }
}
